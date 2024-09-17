<?php

namespace App\Http\Controllers;

use App\Models\VideoCourse;
use App\Http\Requests\StoreVideoCourseRequest;
use App\Http\Requests\UpdateVideoCourseRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DataTables;
use App\Models\Video;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;
use App\DataTables\VideoCoursesDataTable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class VideoCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(VideoCoursesDataTable $dataTable, Request $request)
    {
        // try {
            $perPage = $request->input('per_page', 10);
            $videoCourses = VideoCourse::with('videos')->paginate($perPage)->appends($request->query());
           
            return $dataTable->render('ins.content.videocourse', [
                'videoCourses' => $videoCourses,
            ]);
        // } catch (\Exception $e) {
        //     Log::error('Error in index method: ' . $e->getMessage());
        //     Alert::error('Error', 'An error occurred while loading video courses.');
        //     return redirect()->back();
        // }
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('ins.content.videocourse');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVideoCourseRequest $request)
    {
        try {
            // Validate the request data
            $validatedData = $request->validated();
    
            // Handle Banner Upload
            if ($request->hasFile('banner')) {
                $bannerFile = $request->file('banner');
                $destinationPath = 'upload_banner'; // Removed leading slash
                $fileName = time() . '_' . $bannerFile->getClientOriginalName();
                $bannerFile->move(public_path($destinationPath), $fileName);
                $validatedData['banner'] = $destinationPath . '/' . $fileName;
            }
    
            // Calculate Course Duration
            $fromDate = \Carbon\Carbon::parse($validatedData['from']);
            $toDate = \Carbon\Carbon::parse($validatedData['to']);
            $courseDuration = $fromDate->diffInDays($toDate);
            $validatedData['course_duration'] = $courseDuration;
    
            // Create Video Course
            $videoCourse = VideoCourse::create($validatedData);
    
            // Handle Multiple Video Uploads and store in the `videos` table
            if ($request->hasFile('videos')) {
                foreach ($request->file('videos') as $video) {
                    $destinationVideo = 'video'; // Removed leading slash
                    $videoFileName = time() . '_' . $video->getClientOriginalName();
                    $video->move(public_path($destinationVideo), $videoFileName);
    
                    // Create a new entry in the videos table
                    $videoCourse->videos()->create([
                        'video_path' => $destinationVideo . '/' . $videoFileName
                    ]);
                }
            }
    
            Alert::success('Success', 'The Video Course has been created successfully.');
            return redirect()->back();
        } catch (\Exception $e) {
            Log::error('Error storing video course: ' . $e->getMessage());
            Alert::error('Error', 'An error occurred while creating the video course.');
            return redirect()->back()->withInput();
        }
    }
    
    /**
     * Display the specified resource.
     */
    public function show(VideoCourse $videoCourse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, VideoCoursesDataTable $dataTable, Request $request)
    {
        try {
            // Fetch the video course and associated videos
            $single_data = VideoCourse::with('videos')->findOrFail($id);
    
            // Handle pagination for DataTables
            $perPage = $request->input('per_page', 10);
            $videoCourses = VideoCourse::with('videos')->paginate($perPage)->appends($request->query());
    
            return $dataTable->render('ins.content.videocourse', [
                'single_data' => $single_data,
                'videoCourses' => $videoCourses,
            ]);
        } catch (\Exception $e) {
            Log::error('Error in edit method: ' . $e->getMessage());
            Alert::error('Error', 'An error occurred while loading video course details.');
            return redirect()->back();
        }
    }
    
    public function showVideos($id)
    {
        $videoCourse = VideoCourse::with('videos')->findOrFail($id);
        return view('ins.content.videos', compact('videoCourse'));
    }

    public function uploadVideos(Request $request)
    {
        try {
            $request->validate([
                'course_id' => 'required|exists:video_courses,id',
                'image.*' => 'required|file|mimes:mp4,mov,avi|max:102400', // 100MB max
            ]);
    
            $videoCourse = VideoCourse::findOrFail($request->course_id);
    
            if ($request->hasFile('image')) {
                foreach ($request->file('image') as $video) {
                    $destinationVideo = 'video';
                    $videoFileName = time() . '_' . $video->getClientOriginalName();
                    $video->move(public_path($destinationVideo), $videoFileName);
    
                    // Create a new entry in the videos table
                    $videoCourse->videos()->create([
                        'video_path' => $destinationVideo . '/' . $videoFileName
                    ]);
                }
            }
    
            return response()->json(['success' => 'Videos uploaded successfully'], 200);
            // Alert::success('Success', 'Videos added successfully');
        } catch (\Exception $e) {
            Log::error('Error uploading videos: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while uploading videos.'], 500);
        }
    }
    public function deleteMultiple(Request $request)
    {
        $videoIds = $request->input('videos', []);
    
        if (empty($videoIds)) {
            return redirect()->back()->with('error', 'No videos selected for deletion');
        }
    
        // Fetch videos and soft delete each one
        $videos = Video::whereIn('id', $videoIds)->get();
    
        foreach ($videos as $video) {
            $video->delete(); // Soft delete the video record


            // if (Storage::disk('public')->exists($video->video_path)) {
            //     Storage::disk('public')->delete($video->video_path);
            // }
        }
    
        Alert::success('Success', 'Videos deleted successfully');
        
        return redirect()->back(); // Redirect to the video course page

    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $videoCourse = VideoCourse::findOrFail($id);
    
        $validatedData = $request->validate([
            'course_name' => 'required|string|max:255',
            'language' => 'required|in:1,2',
            'original_price' => 'required|numeric|min:0',
            'discount_price' => 'required|numeric|min:0',
            'course_category_id' => 'required|exists:course_categories,id',
            'from' => 'required|date',
            'to' => 'required|date|after:from',
            'about_course' => 'required|string',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Handle banner upload if a new one is provided
        if ($request->hasFile('banner')) {
            // Delete the old banner if it exists
            if ($videoCourse->banner && file_exists(public_path($videoCourse->banner))) {
                unlink(public_path($videoCourse->banner));
            }
    
            $bannerFile = $request->file('banner');
            $destinationPath = 'upload_banner';
            $fileName = time() . '_' . $bannerFile->getClientOriginalName();
            $bannerFile->move(public_path($destinationPath), $fileName);
            
            $validatedData['banner'] = $destinationPath . '/' . $fileName;
        }
    
        // Calculate course duration
        $fromDate = Carbon::parse($validatedData['from']);
        $toDate = Carbon::parse($validatedData['to']);
        $validatedData['course_duration'] = $fromDate->diffInDays($toDate);
    
        $videoCourse->update($validatedData);
        Alert::success('success', 'Video Course updated successfully');
        return redirect()->back();
        // return redirect()->route('videocourse.index')->with('success', 'Video course updated successfully.');
    }

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            // Find the video or throw an exception if not found
            $video = Video::findOrFail($id);
    
            // Delete the video file from the public storage if it exists
            // if (Storage::disk('public')->exists($video->video_path)) {
            //     Storage::disk('public')->delete($video->video_path);
            // }
            
            // Soft delete the video record from the database
            $video->delete();
    
            Alert::success('Success', 'Video deleted successfully');
            return redirect()->back();
        } catch (Exception $e) {
            // Log the error and show an alert if something goes wrong
            Log::error('Error in destroy method: ' . $e->getMessage());
            Alert::error('Error', 'An error occurred while deleting the video.');
            return redirect()->back();
        }
    }

   
}

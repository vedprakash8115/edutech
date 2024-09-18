<?php

namespace App\Http\Controllers;

use App\Models\VideoCourse;
use App\Http\Requests\StoreVideoCourseRequest;
use App\Http\Requests\UpdateVideoCourseRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\CourseCategory0;
use DataTables;
use App\Models\Video;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;
use App\DataTables\VideoCoursesDataTable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Jobs\VidUpload;

class VideoCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(VideoCoursesDataTable $dataTable, Request $request)
    {
        try {
            $perPage = $request->input('per_page', 10);
            $videoCourses = VideoCourse::with('videos')->paginate($perPage)->appends($request->query());
            $categories = CourseCategory0::all();
            return $dataTable->render('ins.content.videocourse', [
                'videoCourses' => $videoCourses,
                'categories' => $categories,
            ]);
        } catch (\Exception $e) {
            Log::error('Error in index method: ' . $e->getMessage());
            // toast('An error occurred while loading video courses.', 'error');
            Alert::toast('An error occurred while loading video courses.', 'error');
            return redirect()->back();
        }
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        try {
            return view('ins.content.videocourse');
        } catch (\Exception $e) {
            Log::error('Error in create method: ' . $e->getMessage());
            // toast('An error occurred while loading the create form.', 'error');
            Alert::toast('Error in create method: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVideoCourseRequest $request)
    {
        try {
            DB::beginTransaction();

            $validatedData = $request->validated();
    
            if ($request->hasFile('banner')) {
                $bannerFile = $request->file('banner');
                $destinationPath = 'upload_banner';
                $fileName = time() . '_' . $bannerFile->getClientOriginalName();
                $bannerFile->move(public_path($destinationPath), $fileName);
                $validatedData['banner'] = $destinationPath . '/' . $fileName;
            }
    
            $fromDate = \Carbon\Carbon::parse($validatedData['from']);
            $toDate = \Carbon\Carbon::parse($validatedData['to']);
            $courseDuration = $fromDate->diffInDays($toDate);
            $validatedData['course_duration'] = $courseDuration;
    
            $videoCourse = VideoCourse::create($validatedData);
    
            if ($request->hasFile('videos')) {
                foreach ($request->file('videos') as $video) {
                    $destinationVideo = 'video';
                    $videoFileName = time() . '_' . $video->getClientOriginalName();
                    $video->move(public_path($destinationVideo), $videoFileName);
    
                    $videoCourse->videos()->create([
                        'video_path' => $destinationVideo . '/' . $videoFileName
                    ]);
                }
            }
    
            DB::commit();
            // toast('The Video Course has been created successfully.', 'success');

            Alert::toast('The Video Course has been created successfully.', 'success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error storing video course: ' . $e->getMessage());
            // toast('An error occurred while creating the video course.', 'error');
            Alert::toast('Error storing video course', 'error');
            return redirect()->back()->withInput();
        }
    }
    
    /**
     * Display the specified resource.
     */
    public function show(VideoCourse $videoCourse)
    {
        try {
            return view('ins.content.videocourse-show', compact('videoCourse'));
        } catch (\Exception $e) {
            Log::error('Error in show method: ' . $e->getMessage());
            // toast('An error occurred while displaying the video course.', 'error');
            Alert::toast('Some error has occured in the show method', 'error');
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, VideoCoursesDataTable $dataTable, Request $request)
    {
        try {
            $single_data = VideoCourse::with('videos')->findOrFail($id);
            $categories = CourseCategory0::all();
            $perPage = $request->input('per_page', 10);
            $videoCourses = VideoCourse::with('videos')->paginate($perPage)->appends($request->query());
    
            return $dataTable->render('ins.content.videocourse', [
                'single_data' => $single_data,
                'videoCourses' => $videoCourses,
                'categories' => $categories,
            ]);
        } catch (\Exception $e) {
            Log::error('Error in edit method: ' . $e->getMessage());
            // toast('An error occurred while loading video course details.', 'error');
            Alert::toast('An error occurred while loading video course details.', 'error');
            return redirect()->back();
        }
    }
    
    public function showVideos($id)
    {
        try {
            $videoCourse = VideoCourse::with('videos')->findOrFail($id);
            return view('ins.content.videos', compact('videoCourse'));
        } catch (\Exception $e) {
            Log::error('Error in showVideos method: ' . $e->getMessage());
            toast('An error occurred while loading videos.', 'error');
            return redirect()->back();
        }
    }

    public function uploadVideos(Request $request)
    {
        try {
            $request->validate([
                'course_id' => 'required|exists:video_courses,id',
                'image.*' => 'required|file|mimes:mp4,mov,avi|max:102400',
            ]);
    
            $videoCourse = VideoCourse::findOrFail($request->course_id);
    
            if ($request->hasFile('image')) {
                foreach ($request->file('image') as $video) {
                    $destinationVideo = 'video';
                    $videoFileName = time() . '_' . $video->getClientOriginalName();
                    $video->move(public_path($destinationVideo), $videoFileName);
    
                    $videoCourse->videos()->create([
                        'video_path' => $destinationVideo . '/' . $videoFileName
                    ]);
                }
            }
    
            // return response()->json(['success' => 'Videos uploaded successfully'], 200);
            Alert::toast('Videos uploaded successfully', 'success');
        } catch (\Exception $e) {
            Log::error('Error uploading videos: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while uploading videos.'], 500);
        }
    }

    public function deleteMultiple(Request $request)
    {
        try {
            $videoIds = $request->input('videos', []);
    
            if (empty($videoIds)) {
                toast('No videos selected for deletion', 'warning');
                return redirect()->back();
            }
    
            $videos = Video::whereIn('id', $videoIds)->get();
    
            foreach ($videos as $video) {
                $video->delete();
            }
    
            toast('Videos deleted successfully', 'success');
            return redirect()->back();
        } catch (\Exception $e) {
            Log::error('Error in deleteMultiple method: ' . $e->getMessage());
            toast('An error occurred while deleting videos.', 'error');
            return redirect()->back();
        }
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $videoCourse = VideoCourse::findOrFail($id);
    
            $validatedData = $request->validate([
                'course_name' => 'required|string|max:255',
                'language' => 'required|in:1,2',
                'is_paid' => 'boolean',
                'price' => 'nullable|numeric|min:0',
                'discount_price' => 'nullable|numeric|min:0',
                'course_category_id' => 'required',
                'from' => 'required|date',
                'to' => 'required|date|after:from',
                'about_course' => 'required|string',
                'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
    
            if ($request->input('is_paid') == 0) {
                $validatedData['price'] = null;
                $validatedData['discount_price'] = null;
            } elseif ($request->input('is_paid') == 1 && is_null($request->input('price'))) {
                return redirect()->back()->withErrors([
                    'price' => 'The price is required for paid courses.'
                ])->withInput();
            }
    
            if ($request->hasFile('banner')) {
                if ($videoCourse->banner && file_exists(public_path($videoCourse->banner))) {
                    unlink(public_path($videoCourse->banner));
                }
    
                $bannerFile = $request->file('banner');
                $destinationPath = 'upload_banner';
                $fileName = time() . '_' . $bannerFile->getClientOriginalName();
                $bannerFile->move(public_path($destinationPath), $fileName);
    
                $validatedData['banner'] = $destinationPath . '/' . $fileName;
            }
    
            $fromDate = Carbon::parse($validatedData['from']);
            $toDate = Carbon::parse($validatedData['to']);
            $validatedData['course_duration'] = $fromDate->diffInDays($toDate);
    
            $videoCourse->update($validatedData);
    
            toast('Video Course updated successfully', 'success');
            return redirect()->back();
        } catch (\Exception $e) {
            Log::error('Error in update method: ' . $e->getMessage());
            toast('An error occurred while updating the video course.', 'error');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $video = Video::findOrFail($id);
            $video->delete();
    
            toast('Video deleted successfully', 'success');
            return redirect()->back();
        } catch (\Exception $e) {
            Log::error('Error in destroy method: ' . $e->getMessage());
            toast('An error occurred while deleting the video.', 'error');
            return redirect()->back();
        }
    }
}

// Testing-----------------------------------------------------------------------------

// public function store(StoreVideoCourseRequest $request)
// {
//     try {
//         // Validate the request data
//         $validatedData = $request->validated();

//         // Extract only the necessary data for the course creation
//         $courseData = [
//             'course_name' => $validatedData['course_name'],
//             'language' => $validatedData['language'],
//             'is_paid' => $validatedData['is_paid'],
//             'price' => $validatedData['price'] ?? null,
//             'discount_price' => $validatedData['discount_price'] ?? null,
//             'course_category_id' => $validatedData['course_category_id'],
//             'from' => $validatedData['from'],
//             'to' => $validatedData['to'],
//             'about_course' => $validatedData['about_course'],
//             // Add any other fields that are part of your VideoCourse model
//         ];

//         // Handle Banner Upload
//         $bannerPath = null;
//         if ($request->hasFile('banner')) {
//             $bannerFile = $request->file('banner');
//             $bannerPath = $bannerFile->store('tmp', 'public');
//         }

//         // Handle Video Uploads
//         $videoPaths = [];
//         if ($request->hasFile('videos')) {
//             foreach ($request->file('videos') as $video) {
//                 $videoPaths[] = $video->store('tmp', 'public');
//             }
//         }

//         // Dispatch the job with course data and file paths
//         ProcessVideoCourse::dispatch($courseData, $bannerPath, $videoPaths);

//         Alert::success('Success', 'The Video Course is being processed.');
//         return redirect()->back();
//     } catch (\Exception $e) {
//         Log::error('Error dispatching job: ' . $e->getMessage());
//         Alert::error('Error', 'An error occurred while processing the video course.');
//         return redirect()->back()->withInput();
//     }
// }
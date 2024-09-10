<?php

namespace App\Http\Controllers;

use App\Models\VideoCourse;
use App\Http\Requests\StoreVideoCourseRequest;
use App\Http\Requests\UpdateVideoCourseRequest;
use App\Models\CourseCategory;
use App\Models\CourseCategory0;
use App\Models\CourseSubCategory;
use Illuminate\Http\Request;

class VideoCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);

        $videoCourseies = VideoCourse::query()
            ->paginate($perPage)
            ->appends($request->query());

        $courseCategory0 = CourseCategory0::all();

        return view('ins.content.videocourse', [
            'videoCourseies' => $videoCourseies,
            'courseCategory0' => $courseCategory0,

        ]);
        // return view('ins.content.videocourse');
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
        // dd($request->all());
        $validatedData = $request->validated();

        // Handle Banner Upload
        if ($request->hasFile('banner')) {
            $bannerFile = $request->file('banner');
            $destinationPath = '/upload_banner';
            $fileName = time() . '_' . $bannerFile->getClientOriginalName();
            $bannerFile->move(public_path($destinationPath), $fileName);
            $validatedData['banner'] = $destinationPath . '/' . $fileName;
        }

        // Handle Video Upload
        // if ($request->hasFile('video')) {
        //     $video = $request->file('video');
        //     $destinationVideo = '/video';
        //     $videoFileName = time() . '_' . $video->getClientOriginalName();
        //     $video->move(public_path($destinationVideo), $videoFileName);
        //     $validatedData['video'] = $destinationVideo . '/' . $videoFileName;
        // }

        if ($request->hasFile('video')) {
            $videos = $request->file('video');
            $videoPaths = []; 
            foreach ($videos as $video) {
                $destinationVideo = '/video';
                $videoFileName = time() . '_' . $video->getClientOriginalName();
                $video->move(public_path($destinationVideo), $videoFileName);
                $videoPaths[] = $destinationVideo . '/' . $videoFileName; // Store the path
            }

            // You can store the paths in your database
            $validatedData['videos'] = json_encode($videoPaths); // Store the video paths as a JSON array
        }


        $fromDate = \Carbon\Carbon::parse($validatedData['form']);
        $toDate = \Carbon\Carbon::parse($validatedData['to']);
        $courseDuration = $fromDate->diffInDays($toDate);
        $validatedData['course_duration'] = $courseDuration;


        VideoCourse::create($validatedData);
        return redirect()->back()->with('message', 'The Live Class has been created successfully.');
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
    public function edit(VideoCourse $videoCourse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVideoCourseRequest $request, VideoCourse $videoCourse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VideoCourse $videoCourse)
    {
        //
    }
    public function getSubcategories($id)
    {
        // Retrieve subcategories based on the category ID
        $subcategories = CourseCategory::where('cat0_id', $id)->get();
        return response()->json($subcategories);
    }


    public function getSubcategories2($categoryId)
    {
        $subcategories2 = CourseSubCategory::where('category_id', $categoryId)->get();
        return response()->json($subcategories2);
    }
}

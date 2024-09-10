<?php

namespace App\Http\Controllers;

use App\Models\VideoCourse;
use App\Http\Requests\StoreVideoCourseRequest;
use App\Http\Requests\UpdateVideoCourseRequest;
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
             return view('ins.content.videocourse', [
            'videoCourseies' => $videoCourseies,
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
        if ($request->hasFile('video')) {
            $video = $request->file('video');
            $destinationVideo = '/video';
            $videoFileName = time() . '_' . $video->getClientOriginalName();
            $video->move(public_path($destinationVideo), $videoFileName);
            $validatedData['video'] = $destinationVideo . '/' . $videoFileName;
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
}

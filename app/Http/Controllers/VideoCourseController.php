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
    
        if ($request->hasFile('video')) {
            $bannerFile = $request->file('video');
            $destinationPath = '/video';
            $fileName = time() . '_' . $bannerFile->getClientOriginalName();
            $bannerFile->move(public_path($destinationPath), $fileName);
            $validatedData = array_merge($request->validated(), ['video' => $destinationPath . '/' . $fileName]);
        } else {
            $validatedData = $request->validated();
        }
        VideoCourse::create($validatedData);
        return redirect()->back()
            ->with('message', 'The Live Class has been created successfully.');
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

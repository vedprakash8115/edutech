<?php

namespace App\Http\Controllers;

use App\Models\liveClass;
use App\Http\Requests\StoreliveClassRequest;
use App\Http\Requests\UpdateliveClassRequest;
use Illuminate\Http\Request;

class LiveClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);

        $liveClasses = liveClass::query()
            ->paginate($perPage)
            ->appends($request->query());
            return view('ins.content.liveclass', [
            'liveClasses' => $liveClasses,
        ]);
        // return view('ins.content.liveclass');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ins.content.liveclass');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreliveClassRequest $request)
    {
        if ($request->hasFile('upload_banner')) {
            $bannerFile = $request->file('upload_banner');
            $destinationPath = '/upload_banner';
            $fileName = time() . '_' . $bannerFile->getClientOriginalName();
            $bannerFile->move(public_path($destinationPath), $fileName);
            $validatedData = array_merge($request->validated(), ['upload_banner' => $destinationPath . '/' . $fileName]);
        } else {
            $validatedData = $request->validated();
        }
        liveClass::create($validatedData);
        return redirect()->back()
            ->with('message', 'The Live Class has been created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(liveClass $liveClass) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(liveClass $liveClass)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateliveClassRequest $request, liveClass $liveClass)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(liveClass $liveClass)
    {
        //
    }
}

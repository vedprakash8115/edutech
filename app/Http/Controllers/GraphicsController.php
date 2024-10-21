<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use App\Models\Graphics;

class GraphicsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = Graphics::all();
        return view('admin.graphics.index' , compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.graphics.create');
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'logo_width' => 'required|integer|min:50|max:300',
            'logo_height' => 'required|integer|min:50|max:300',
            'logo_horizontal_position' => 'required|in:left,center,right',
            'logo_vertical_position' => 'required|in:top,middle,bottom',
            'header_background_color' => 'required|regex:/^#[a-fA-F0-9]{6}$/',
            'header_border_color' => 'required|regex:/^#[a-fA-F0-9]{6}$/',
            'header_text' => 'required|string|max:255',
            'header_text_color' => 'required|regex:/^#[a-fA-F0-9]{6}$/',
            'header_text_horizontal_position' => 'required|in:left,center,right',
            'header_text_vertical_position' => 'required|in:top,middle,bottom',
            'header_font' => 'required|string|max:100',
            'header_font_size' => 'required|integer|min:8|max:72',
            'custom_url' => 'nullable|url',
            'condition' => 'required|in:none,date,time,interval',
            'from_date' => 'required_if:condition,date|nullable|date',
            'to_date' => 'required_if:condition,date|nullable|date|after:from_date',
            'from_time' => 'required_if:condition,time|nullable|date_format:H:i',
            'to_time' => 'required_if:condition,time|nullable|date_format:H:i|after:from_time',
            'interval' => 'required_if:condition,interval|nullable|in:morning,afternoon,evening,night',
        ]);

        // Handle file upload if a logo was provided
        if ($request->hasFile('logo')) {
            $logoFile = $request->file('logo');
            $fileName = time() . '_' . $logoFile->getClientOriginalName();
            $destinationPath = 'logos'; // Folder for storing logos
    
            // Attempt to move the file to the destination path
            try {
                $logoFile->move(public_path($destinationPath), $fileName);
                $request->logo = $destinationPath . '/' . $fileName;
                $validatedData['logo'] = $destinationPath . '/' . $fileName;
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['logo' => 'Failed to upload logo. Please try again.']);
            }
        }

        // Save the data to the database
        try {
        Graphics::create($validatedData);

            return redirect()->back()->with('status', 'Graphics settings saved successfully!');
        } catch (\Exception $e) {
            \Log::info($e);

            // If there was an error saving to the database, delete the uploaded file (if any)
            // if (isset($logoPath)) {
            //     Storage::disk('public')->delete($logoPath);
            // }

            return redirect()->back()->withErrors(['error' => 'Failed to save graphics settings. Please try again.']);
        }
    }
    /**
     * Store a newly created resource in storage.
     

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function getGraphicsSettings()
{
    try {
        // Fetch data from the `graphics_settings` table
        $graphicsSettings = Graphics::all();

        // Return the data as JSON
        return response()->json([
            'success' => true,
            'data' => $graphicsSettings
        ], 200);
    } catch (\Exception $e) {
        // Handle any errors and return an error response
        return response()->json([
            'success' => false,
            'message' => 'Failed to retrieve graphics settings. Please try again.',
            'error' => $e->getMessage()
        ], 500);
    }
}

}

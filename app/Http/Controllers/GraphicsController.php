<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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

    /**
     * Store a newly created resource in storage.
     */public function store(Request $request)
{
    // Validate input data
    $validatedData = $request->validate([
        'logo' => 'nullable|image|max:2048',
        'logo_width' => 'required|integer|min:50|max:300',
        'logo_height' => 'required|integer|min:50|max:300',
        'background_color' => 'required|string',
        'gradient_color_2' => 'nullable|string',
        'custom_text' => 'nullable|string|max:255',
        'text_size' => 'required|in:small,medium,large',
        'text_color' => 'required|string',
        'custom_url' => 'nullable|url',
        'condition' => 'required|in:none,date,time,interval',
        'from_date' => 'nullable|required_if:condition,date|date',
        'to_date' => 'nullable|required_if:condition,date|date|after:from_date',
        'from_time' => 'nullable|required_if:condition,time|date_format:H:i',
        'to_time' => 'nullable|required_if:condition,time|date_format:H:i|after:from_time',
        'interval' => 'nullable|required_if:condition,interval|in:morning,afternoon,evening,night',
    ]);

    // Create a new Graphics instance
    $settings = new Graphics();

    // Handle logo file upload if provided
    if ($request->hasFile('logo')) {
        $logoFile = $request->file('logo');
        $fileName = time() . '_' . $logoFile->getClientOriginalName();
        $destinationPath = 'logos'; // Folder for storing logos

        // Attempt to move the file to the destination path
        try {
            $logoFile->move(public_path($destinationPath), $fileName);
            $settings->logo = $destinationPath . '/' . $fileName;
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['logo' => 'Failed to upload logo. Please try again.']);
        }
    }

    // Save the validated data to the settings object
    $settings->logo_width = $validatedData['logo_width'];
    $settings->logo_height = $validatedData['logo_height'];
    $settings->background_color = $validatedData['background_color'];
    $settings->gradient_color_2 = $validatedData['gradient_color_2'] ?? null;
    $settings->custom_text = $validatedData['custom_text'] ?? null;
    $settings->text_size = $validatedData['text_size'];
    $settings->text_color = $validatedData['text_color'];
    $settings->custom_url = $validatedData['custom_url'] ?? null;
    $settings->condition = $validatedData['condition'];

    // Handle conditional settings
    if ($validatedData['condition'] === 'date') {
        $settings->from_date = $validatedData['from_date'];
        $settings->to_date = $validatedData['to_date'];
    } elseif ($validatedData['condition'] === 'time') {
        $settings->from_time = $validatedData['from_time'];
        $settings->to_time = $validatedData['to_time'];
    } elseif ($validatedData['condition'] === 'interval') {
        $settings->interval = $validatedData['interval'];
    }

    // Save the settings to the database
    $settings->save();

    // Redirect back with a success message
    return redirect()->back()->with('status', 'Settings saved successfully!');
}


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
}

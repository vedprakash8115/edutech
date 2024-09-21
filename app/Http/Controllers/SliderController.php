<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Slider::get(); // Adjust as necessary

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function($row) {
                    return '<img src="'. asset($row->image) .'" width="50" height="50" />';
                })
                ->addColumn('status', function($row) {
                    return '<label class="switch">
                                <input type="checkbox" class="status-switch" data-id="'.$row->id.'" '.($row->status ? 'checked' : '').'>
                                <span class="slider"></span>
                            </label>';
                })
                ->addColumn('actions', function($row) {
                    return '
                        <a href="'. route('sliders.edit', $row->id) .'" class="btn btn-primary btn-sm">Edit</a>
                        <form action="'. route('sliders.destroy', $row->id) .'" method="POST" style="display:inline;">
                            '. csrf_field() .'
                            '. method_field('DELETE') .'
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure?\')">Delete</button>
                        </form>
                    ';
                })
                ->rawColumns(['image','status', 'actions'])
                ->make(true);
        }

        return view('marketing.sliders.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $existingPositions = Slider::pluck('position')->toArray(); // Fetch existing positions
        return view('marketing.sliders.create', compact('existingPositions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validate the request
            $request->validate([
                'title' => 'required|string|max:255',
                'image' => 'required|image|mimes:jpeg,jpg,gif|max:5120',
                'position' => 'required|integer|unique:sliders,position',
                'link' => 'nullable|url',
                'button_name' => 'nullable|string|max:255',
                'description' => 'required|string|max:1000',
            ]);

            // Handle the image upload
            if ($request->hasFile('image')) {
                $name = 'slider-'.time().'-'.rand(0,100).'.'.$request->image->extension();
                $path = public_path('slider');
                $request->image->move($path, $name);
                $imagePath = 'slider/'.$name;
            }

            // Create the slider record
            Slider::create([
                'title' => $request->title,
                'image' => $imagePath ?? null,
                'position' => $request->position,
                'link' => $request->link??null,
                'button_name' => $request->button_name?? null,
                'description' => $request->description?? null,
            ]);

            Alert::toast('Slider added successfully!', 'success');
            return redirect()->route('sliders.index');
        } catch (\Exception $e) {
            Alert::toast('Failed to add slider. Please try again.', 'error');
            return redirect()->route('sliders.create')->withInput();
        }
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
        $single_data = Slider::findOrFail($id);
        $existingPositions = Slider::where('id', '!=', $id)->pluck('position')->toArray();
        return view('marketing.sliders.create', compact('single_data','existingPositions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
                'position' => 'nullable|integer|unique:course_categories,name,'.$id,
                'link' => 'nullable|url',
                'button_name' => 'nullable|string|max:255',
                'description' => 'required|string|max:1000',
            ]);

            $slider = Slider::findOrFail($id);
            $imagePath = $slider->image; // Keep the existing image path

            // Handle the image upload if a new image is provided
            if ($request->hasFile('image')) {
                $name = 'slider-'.time().'-'.rand(0,100).'.'.$request->image->extension();
                $path = public_path('slider');
                $request->image->move($path, $name);
                $imagePath = 'slider/'.$name;
            }

            $slider->update([
                'title' => $request->title??$slider->title,
                'image' => $imagePath??$slider->image,
                'position' => $request->position??$slider->position,
                'link' => $request->link??$slider->link,
                'button_name' => $request->button_name??$slider->button_name,
                'description' => $request->description??$slider->description,
            ]);

            Alert::toast('Slider updated successfully!', 'success');
            return redirect()->route('sliders.index');
        } catch (\Exception $e) {
            Alert::toast('Failed to update slider. Please try again.', 'error');
            return redirect()->route('sliders.edit', $id)->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function updateStatus(Request $request, string $id)
    {
        try {
            $slider = Slider::findOrFail($id);
            $slider->status = $request->status;
            $slider->save();

            return response()->json(['success' => true]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to update status.'], 500);
        }
    }
}

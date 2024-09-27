<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Testimonial::with('user', 'role')->get(); // Adjust as necessary

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
                        <a href="'. route('testimonials.edit', $row->id) .'" class="btn btn-primary btn-sm">Edit</a>
                        <form action="'. route('testimonials.destroy', $row->id) .'" method="POST" style="display:inline;">
                            '. csrf_field() .'
                            '. method_field('DELETE') .'
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure?\')">Delete</button>
                        </form>
                    ';
                })
                ->rawColumns(['image','status', 'actions'])
                ->make(true);
        }

        return view('marketing.testimonial.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users_list = User::orderBy('id','desc')->get();
        $roles = Role::orderBy('id','desc')->get();
        return view('marketing.testimonial.create', compact('users_list','roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validate the request
            $request->validate([
                'name' => 'required|exists:users,id',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'role_id' => 'nullable|exists:roles,id',
                'description' => 'required|string|max:500',
            ]);

            // Handle the image upload
            if ($request->hasFile('image')) {
                $name = 'testimonial-'.time().'-'.rand(0,100).'.'.$request->image->extension();
                $path = public_path('testimonial');
                $request->image->move($path, $name);
                $imagePath = 'testimonial/'.$name;
            }

            // Create the testimonial record
            Testimonial::create([
                'user_id' => $request->name,
                'image' => $imagePath ?? null,
                'role_id' => $request->role_id,
                'description' => $request->description,
            ]);

            // Toast message for success
            Alert::toast('Testimonial added successfully!', 'success');

            return redirect()->route('testimonials.index');
        } catch (Exception $e) {
            Alert::toast('Failed to add testimonial. Please try again.', 'error');

            return redirect()->route('testimonials.create')->withInput();
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
        $single_data = Testimonial::findOrFail($id);
        $users_list = User::orderBy('id', 'desc')->get();
        $roles = Role::orderBy('id', 'desc')->get();
        return view('marketing.testimonial.create', compact('single_data', 'users_list', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'name' => 'required|exists:users,id',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'role_id' => 'required|exists:roles,id',
                'description' => 'required|string|max:500',
            ]);

            $testimonial = Testimonial::findOrFail($id);
            $imagePath = $testimonial->image; // Keep the existing image path

            // Handle the image upload if a new image is provided
            if ($request->hasFile('image')) {
                $name = 'testimonial-'.time().'-'.rand(0,100).'.'.$request->image->extension();
                $path = public_path('testimonial');
                $request->image->move($path, $name);
                $imagePath = 'testimonial/'.$name;
            }

            $testimonial->update([
                'user_id' => $request->name??$testimonial->user_id,
                'image' => $imagePath??$testimonial->image,
                'role_id' => $request->role_id??$testimonial->role_id,
                'description' => $request->description??$testimonial->description,
            ]);

            Alert::toast('Testimonial updated successfully!', 'success');
            return redirect()->route('testimonials.index');
        } catch (Exception $e) {
            Alert::toast('Failed to update testimonial. Please try again.', 'error');
            return redirect()->route('testimonials.index', $id)->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $testimonial = Testimonial::findOrFail($id);

            // Delete the image file if it exists
            if ($testimonial->image && file_exists(public_path($testimonial->image))) {
                unlink(public_path($testimonial->image));
            }
            $testimonial->delete();
            Alert::toast('Testimonial deleted successfully!', 'success');
            return redirect()->route('testimonials.index');
        } catch (Exception $e) {
            Alert::toast('Failed to delete testimonial. Please try again.', 'error');
            return redirect()->route('testimonials.index');
        }
    }

    public function getRolesByUser($id)
    {
        $user = User::findOrFail($id);
        // Get roles using Spatie's method

        $roles = $user->roles()->first();
        return response()->json(['roles' => $roles]);
    }

    public function updateStatus(Request $request, string $id)
    {
        try {
            $testimonial = Testimonial::findOrFail($id);
            $testimonial->status = $request->status;
            $testimonial->save();

            return response()->json(['success' => true]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to update status.'], 500);
        }
    }


}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */ 
     public function all()
{
    // Retrieve all users from the database
    $users = User::all();

    // Return the list of users
    return response()->json($users);
}

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::with('role')->get(); // Assuming 'role' is a relationship

            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('status', function($user){
                    $statusBadge = $user->status
                        ? "Active"
                        : "Inactive";
                    return $statusBadge;
                })
                ->addColumn('role', function($user){
                    return $user->role ? $user->role->name : 'N/A'; // Return role name or N/A if no role
                })
                ->addColumn('action', function($row){
                    return '<a href="'.route('users.edit', $row->id).'" class="btn btn-info btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            <form action="'.route('users.destroy', $row->id).'" method="POST" style="display:inline;">
                                '.csrf_field().'
                                '.method_field('DELETE').'
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></button>
                            </form>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('user.index'); // Change to the path of your Blade view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::get();
        return view('user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validate the request
            $request->validate([
                'name' => 'required|string|max:255',
                'last_name' => 'nullable|string|max:255',
                'email' => 'required|email|max:255|unique:users,email',
                'mobile' => 'required|numeric|digits:10|unique:users,mobile',
                'address' => 'nullable|string|max:255',
                'city' => 'nullable|string|max:255',
                'state' => 'nullable|string|max:255',
                'country' => 'nullable|string|max:255',
                'pincode' => 'nullable|numeric|digits:6',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'status' => 'nullable|in:0,1',
                'role_id' => 'nullable|string',
                'details' => 'nullable|string',
                'facebook_link' => 'nullable|url',
                'youtube_url' => 'nullable|url',
                'twitter_url' => 'nullable|url',
                'linkedin_url' => 'nullable|url',
                'password' => [
                    'required',
                    'string',
                    'min:8', // Minimum length
                    'regex:/[A-Z]/', // At least one uppercase letter
                    'regex:/[a-z]/', // At least one lowercase letter
                    'regex:/[0-9]/', // At least one number
                    'regex:/[@$!%*?&#]/', // At least one special character
                ],
            ]);

            // Handle file upload
            $imagePath = null;
            if($request->has('image')){
                $name =  'image'.rand(0,100).time().'.'.$request->image->extension();
                $imagePath =   public_path().'/image';
                $request->image->move($imagePath,$name);
            }

            // Create user
           $user =  User::create([
                'name' => $request->name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'country' => $request->country,
                'pincode' => $request->pincode,
                'image' => $imagePath,
                'status' => $request->status ?? 1,
                'role_id' => $request->role_id,
                'details' => $request->details,
                'facebook_link' => $request->facebook_link,
                'youtube_url' => $request->youtube_url,
                'twitter_url' => $request->twitter_url,
                'linkedin_url' => $request->linkedin_url,
                'password' => Hash::make($request->password),
            ]);
            $role = Role::findById($request->role_id); // Fetch role by ID
            $user->assignRole($role);
            Alert::toast('User successfully added!', 'success');
        } catch (ValidationException $e) {
            Alert::error( 'error', 'Validation error: ' . $e->getMessage());
        } catch (Exception $e) {
            Alert::toast('An error occurred while adding the user: ' . $e->getMessage(), 'error');
        }

        return redirect()->back();
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

        try {
            $roles      = Role::get();
            $single_data= User::findOrFail($id);
            return view('user.create', compact('roles','single_data'));
        } catch (Exception $e) {
            Alert::toast('An error occurred while editing the user: ' . $e->getMessage(), 'error');
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            // Validate the request
            $request->validate([
                'name' => 'nullable|string|max:255',
                'last_name' => 'nullable|string|max:255',
                'email' => 'nullable|email|max:255|unique:users,email,' . $id,
                'mobile' => 'nullable|numeric|digits:10|unique:users,mobile,' . $id,
                'address' => 'nullable|string|max:255',
                'city' => 'nullable|string|max:255',
                'state' => 'nullable|string|max:255',
                'country' => 'nullable|string|max:255',
                'pincode' => 'nullable|numeric|digits:6',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'status' => 'nullable|in:0,1',
                'role_id' => 'nullable|string',
                'details' => 'nullable|string',
                'facebook_link' => 'nullable|url',
                'youtube_url' => 'nullable|url',
                'twitter_url' => 'nullable|url',
                'linkedin_url' => 'nullable|url',
                'password' => [
                    'nullable',
                    'string',
                    'min:8', // Minimum length
                    'regex:/[A-Z]/', // At least one uppercase letter
                    'regex:/[a-z]/', // At least one lowercase letter
                    'regex:/[0-9]/', // At least one number
                    'regex:/[@$!%*?&#]/', // At least one special character
                ],
            ]);

            // Find the user
            $user = User::findOrFail($id);

            // Handle file upload
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($user->image && file_exists(public_path($user->image))) {
                    unlink(public_path($user->image));
                }

                $name = 'image' . rand(0, 100) . time() . '.' . $request->image->extension();
                $imagePath = 'image/' . $name;
                $request->image->move(public_path('image'), $name);
                $user->image = $imagePath;
            }

            // Update user fields
            $user->update([
                'name' => $request->name ?? $user->name,
                'last_name' => $request->last_name ?? $user->last_name,
                'email' => $request->email ?? $user->email,
                'mobile' => $request->mobile ?? $user->mobile,
                'image' => $imagePath?? $user->image,
                'address' => $request->address ?? $user->address,
                'city' => $request->city ?? $user->city,
                'state' => $request->state ?? $user->state,
                'country' => $request->country ?? $user->country,
                'pincode' => $request->pincode ?? $user->pincode,
                'status' => $request->status ?? $user->status,
                'role_id' => $request->role_id ?? $user->role_id,
                'details' => $request->details ?? $user->details,
                'facebook_link' => $request->facebook_link ?? $user->facebook_link,
                'youtube_url' => $request->youtube_url ?? $user->youtube_url,
                'twitter_url' => $request->twitter_url ?? $user->twitter_url,
                'linkedin_url' => $request->linkedin_url ?? $user->linkedin_url,
                'password' => $request->password ? Hash::make($request->password) : $user->password,
            ]);

            Alert::toast('User successfully updated!', 'success');
        } catch (ValidationException $e) {
            Alert::error('Validation error: ' . $e->getMessage());
        } catch (Exception $e) {
            Alert::toast('An error occurred while updating the user: ' . $e->getMessage(), 'error');
        }

        return redirect()->back();
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Assuming you have a model called User
            $user = User::findOrFail($id);

            // Attempt to delete the user
            $user->delete();

            // Show a success alert
            Alert::toast('User successfully deleted!', 'success');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Show an error alert when the user is not found
            Alert::toast('User not found.', 'error');
        } catch (\Exception $e) {
            // Show a generic error alert for any other exceptions
            Alert::toast('An error occurred while trying to delete the user.', 'error');
        }

        // Redirect back to the previous page
        return redirect()->back();
    }
 

}

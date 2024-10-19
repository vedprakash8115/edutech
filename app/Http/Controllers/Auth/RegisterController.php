<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\ValidationException;
use Exception;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;


class RegisterController extends Controller
{
    

    public function store(Request $request)
    {
        try {
            $role = Role::where('name', 'student')->first();
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
                $name = 'image'.rand(0, 100).time().'.'.$request->image->extension();
                $imagePath = 'images/'.$name;
                $request->image->move(public_path('images'), $name);
            }
    
            // Create user
            $user = User::create([
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
                'role_id' => $role->id, // use role id instead of role object
                'details' => $request->details,
                'facebook_link' => $request->facebook_link,
                'youtube_url' => $request->youtube_url,
                'twitter_url' => $request->twitter_url,
                'linkedin_url' => $request->linkedin_url,
                'password' => Hash::make($request->password),
            ]);
    
            $user->assignRole($role);
    
            return response()->json([
                'success' => true,
                'message' => 'Student Registered'
            ], 201); // 201 Created
    
        } catch (ValidationException $e) {
            Log::error('Validation error: ' . $e->getMessage());
            return response()->json([
                'error' => true,
                'message' => 'Validation error: ' . $e->getMessage()
            ], 422); // 422 Unprocessable Entity
    
        } catch (Exception $e) {
            Log::error('Error: ' . $e->getMessage());
            return response()->json([
                'error' => true,
                'message' => 'Student not registered'
            ], 500); // 500 Internal Server Error
        }
    }
    
}

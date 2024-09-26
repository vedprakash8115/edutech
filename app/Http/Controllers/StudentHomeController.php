<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Storage;

class StudentHomeController extends Controller
{
    public function index(){
        return view("user-account.content.profile");
    }
    public function updateDetails(Request $request)
    {
        // Validate the form input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|max:15',
            'state' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'password' => 'nullable|string|confirmed',
        ]);

        // Update the user's details
        $user = auth()->user();
        $user->name = $request->name;
        $user->mobile = $request->mobile;
        $user->state = $request->state;
        $user->city = $request->city;

        // Only update the password if it's provided
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->back()->with('success', 'Profile details updated successfully!');
    }

    // Method to update profile image
    public function updateImage(Request $request)
    {
        // Validate the image file
        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Get the logged-in user
        $user = auth()->user();

        // Remove old profile image if it exists
        if ($user->image && file_exists(public_path($user->image))) {
            unlink(public_path($user->image));  // Delete the old image from the public directory
        }

        // Store the new image in the 'public/profile_images' folder
        $imageName = time() . '.' . $request->file('profile_image')->getClientOriginalExtension();  // Create unique image name
        $request->file('profile_image')->move(public_path('profile_images'), $imageName);  // Move file to public/profile_images

        // Update the user's profile image path in the database
        $user->image = 'profile_images/' . $imageName;  // Save the relative path
        $user->save();

        // Return back with success message
        return redirect()->back()->with('success', 'Profile image updated successfully.');
    }


}

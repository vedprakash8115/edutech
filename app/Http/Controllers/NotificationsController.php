<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function index()
    {

    }
    public function create()
    {
        $roles = Role::all();
        return view('admin.notifications.create',compact("roles"));
    }


    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'title' => 'required|max:255',
            'message' => 'required',
            'link_url' => 'nullable|url',
            'image' => 'nullable|image|max:2048', // 2MB Max
            'role' => 'required|in:teacher,student,admin,agent,custom',
            'users' => 'required_if:role,custom|array',
        ]);
    
        // Create the notification instance
        $notification = Notification::create([
            'title' => $request->title,
            'message' => $request->message,
            'link_url' => $request->link_url,
        ]);
    
        // Check if an image was uploaded
        if ($request->hasFile('image')) {
            // Move the image to the public/notifications directory
            $path = $request->file('image')->storeAs(
                'notifications',
                time() . '.' . $request->file('image')->getClientOriginalExtension(),
                'public'
            );
            $notification->image = $path; // Save the path in the database
            $notification->save(); // Save changes to the notification
        }
    
        // Determine users based on the selected role
        if ($request->role === 'custom') {
            $users = User::whereIn('id', $request->users)->get();
        } else {
            $users = (new User())->role($request->role)->get();
        }
    
        // Attach users to the notification
        $notification->users()->attach($users);
    
        // Here you would typically trigger the actual notification sending
        // This could be done via a job queue for better performance
        // For example: SendNotificationJob::dispatch($notification);
    
        return redirect()->back()->with('success', 'Notification created and sent successfully!');
    }
    

    public function getUsersByRole(Request $request)
    {
        $role = Role::findByName($request->role);
        $users = $role->users()->get(['id', 'name', 'email']);
        return response()->json(['success' => true, 'users' => $users]);
    }

    public function getAllUsers()
    {
        $users = User::all(['id', 'name', 'email']);
        return response()->json(['users' => $users]);
    }
public function destroy($id)
{
    $notification = Notification::find($id);

    if (!$notification) {
        return redirect()->back()->withErrors(['error' => 'Notification not found.']);
    }

    // Delete the notification (it will also delete associated entries in notification_user)
    $notification->delete();

    return redirect()->back()->with('success', 'Notification deleted successfully!');
}


}

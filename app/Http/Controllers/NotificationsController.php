<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Services\PusherNotifier;
use DB;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
// use Spatie\Permission\Models\Role;
class NotificationsController extends Controller
{
    protected $pusherNotifier;

    public function __construct(PusherNotifier $pusherNotifier)
    {
        $this->pusherNotifier = $pusherNotifier;
    }
    public function index()
    {
        $roles = Role::all();
        $users = User::all();
        $notifications = Notification::all();
        return view('admin.notifications.index' ,compact('users','notifications','roles'));
    }
    public function create()
    {
        $roles = Role::all();
        return view('admin.notifications.create',compact("roles"));
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
            'link_url' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = 'notifications/' . $imageName;
            $image->move(public_path('notifications'), $imageName);
        }

        $notification = Notification::create([
            'title' => $request->title,
            'message' => $request->message,
            'link_url' => $request->link_url,
            'image_path' => $imagePath ? '/notifications/' . $imageName : null,
        ]);

       

        return redirect()->back()->with('success', 'Notification created successfully.');
    }
    public function send(Request $request) {
        // Validate the request
        $request->validate([
            'notification_id' => 'required|exists:notifications,id',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id',
        ]);
    
        // Retrieve the notification
        $notification = Notification::findOrFail($request->notification_id);
    
        // Get all users associated with the selected roles and check if role is 'student'
        $users = User::whereHas('roles', function ($query) use ($request) {
            $query->whereIn('id', $request->roles);
        })->get();
    
        // Check if any of the selected roles is 'student'
        $isStudentRole = Role::whereIn('id', $request->roles)->where('name', 'student')->exists();
    
        // Broadcast the success message only if 'student' role is selected
        if ($isStudentRole) {
            $this->pusherNotifier->sendMessage(
                'my-channel',
                'NotificationSent',
                $notification->title,
                $notification->message,
                $notification->link_url,
                $notification->image_path
            );
        }
    
        // Send the notification to each user
        foreach ($users as $user) {
            DB::table('notification_user')->insert([
                'notification_id' => $notification->id,
                'user_id' => $user->id,
            ]);
        }
    
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Notification sent successfully.');
    }
    
    
    
    public function edit($id)
    {
        $notification = Notification::findOrFail($id);
        return view('admin.notifications.edit', compact('notification'));
    }
    public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'message' => 'required|string|max:1000',
        'link_url' => 'nullable|url',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $notification = Notification::findOrFail($id);
    $imagePath = $notification->image_path;

    if ($request->hasFile('image')) {
        // Delete old image if exists
        if ($notification->image_path) {
            unlink(public_path($notification->image_path));
        }

        // Save new image
        $image = $request->file('image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $imagePath = 'alerts/' . $imageName;
        $image->move(public_path('alerts'), $imageName);
    }

    $notification->update([
        'title' => $request->title,
        'message' => $request->message,
        'link_url' => $request->link_url,
        'image_path' => $imagePath ? '/alerts/' . $imageName : $notification->image_path,
    ]);

    return redirect()->route('notification.index')->with('success', 'Notification updated successfully.');
}
// public function destroy($id)
// {
//     $notification = Notification::findOrFail($id);

//     if ($notification->image_path) {
//         unlink(public_path($notification->image_path));
//     }

//     $notification->delete();

//     return redirect()->route('notifications.index')->with('success', 'Notification deleted successfully.');
// }

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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PusherNotifier;
use App\Models\Notification;
use App\Models\User;
use App\Models\Role;
use DB;

class TestController extends Controller
{
    protected $pusherNotifier;

    public function __construct(PusherNotifier $pusherNotifier)
    {
        $this->pusherNotifier = $pusherNotifier;
    }

    public function sendNotification(Request $request)
    {
        // Validate the request
        $request->validate([
            'notification_id' => 'required|exists:notifications,id',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id',
            'title' => 'required|string',
            'message' => 'required|string',
            'link_url' => 'nullable|url',
            'image_path' => 'nullable|string',
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
                $request->title,
                $request->message,
                $request->link_url,
                $request->image_path
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
}

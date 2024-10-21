<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Alert;
use Illuminate\Http\Request;
use App\Services\PusherNotifier;
class AlertController extends Controller
{
    protected $pusherNotifier;

    public function __construct(PusherNotifier $pusherNotifier)
    {
        $this->pusherNotifier = $pusherNotifier;
    }
    public function store(Request $request)
    {
        $request->validate([
            'channel' => 'nullable|string|max:255',
            'event' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
            'message' => 'nullable|string',
            'link_url' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $imagePath = null;
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = 'alerts/' . $imageName;
            $image->move(public_path('alerts'), $imageName);
        }
            $message = $request->message;

            // // Broadcast the success message
            $this->pusherNotifier->sendMessage('my-channel', 'NotificationSent', $message);
        Alert::create([
            'channel' => $request->channel,
            'event' => $request->event,
            'title' => $request->title,
            'message' => $request->message,
            'is_read' => false, // Default to unread when creating
            'link_url' => $request->link_url,
            'image_path' => $imagePath ? '/alerts/' . $imageName : null,
        ]);
    
        return redirect()->back()->with('success', 'Alert created successfully.');
    }
    
}

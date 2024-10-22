<?php

namespace App\Services;

use Pusher\Pusher;
use App\Models\Alert;
use Exception;
use Log;

class PusherNotifier
{
    protected $pusher;

    public function __construct()
    {
        $options = [
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'useTLS' => true
        ];

        $this->pusher = new Pusher(
            env('PUSHER_APP_KEY'),      // Your Pusher app key
            env('PUSHER_APP_SECRET'),   // Your Pusher app secret
            env('PUSHER_APP_ID'),       // Your Pusher app ID
            $options
        );
    }

    public function sendMessage($channel, $event, $title, $message, $link_url, $image_path)
    {
        try {
            // Trigger the Pusher event
            $this->pusher->trigger($channel, $event, [
                'title' => $title,
                'message' => $message,
                'link_url' => $link_url,
                'image_path' => $image_path,
            ]);

            // Insert into alerts table
            Alert::create([
                'channel' => $channel,
                'event' => $event,
                'title' => $title,
                'message' => $message,
                'link_url' => $link_url,
                'image_path' => $image_path,
            ]);

        } catch (Exception $e) {
            // Log the error message
            Log::error('Failed to send Pusher notification: ' . $e->getMessage());

            // Optionally, you can return an error message or handle it as per your needs
            return false;
        }

        return true;
    }
}

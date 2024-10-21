<?php
namespace App\Services;

use Pusher\Pusher;
use App\Models\Alert;

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

    public function sendMessage($channel, $event, $message)
    {
        // Trigger the Pusher event
        $this->pusher->trigger($channel, $event, ['message' => $message]);

        // Insert into alerts table
        Alert::create([
            'channel' => $channel,
            'event' => $event,
            'message' => $message
        ]);
    }
}

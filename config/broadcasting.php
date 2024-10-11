<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Broadcaster
    |--------------------------------------------------------------------------
    |
    | This option controls the default broadcaster that will be used by the
    | framework when an event needs to be broadcast. You may set this to
    | any of the connections defined in the "connections" array below.
    |
    | Supported: "pusher", "ably", "redis", "log", "null"
    |
     */

    'default' => env('BROADCAST_DRIVER', 'pusher'),

    /*
    |--------------------------------------------------------------------------
    | Broadcast Connections
    |--------------------------------------------------------------------------
    |
    | Here you may define all of the broadcast connections that will be used
    | to broadcast events to other systems or over websockets. Samples of
    | each available type of connection are provided inside this array.
    |
     */

    'connections' => [

        'pusher' => [
            'driver' => 'pusher',
            'key' => "2ca60163325399dec913",
            'secret' => "16003e4cf5b3b4e8335f",
            'app_id' => '1878072',
            'options' => [
                'cluster' => "ap2",
                'useTLS' => true,
            ],
        ],

            'ably' => [
                'driver' => 'ably',
                'key' => env('ABLY_KEY'),
            ],

            'redis' => [
                'driver' => 'redis',
                'connection' => 'default',
            ],

            'log' => [
                'driver' => 'log',
            ],

            'null' => [
                'driver' => 'null',
            ],

    ],

];

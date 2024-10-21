<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class PusherServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        view()->composer('*', function ($view) {
            $view->with('pusherConfig', [
                'key' => env('PUSHER_APP_KEY'),
                'cluster' => env('PUSHER_APP_CLUSTER'),
                'app_id' => env('PUSHER_APP_ID'),
                'secret' => env('PUSHER_APP_SECRET'),
            ]);
        });
    }
}

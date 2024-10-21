<?php

namespace App\Providers;

use App\Models\Graphics;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class GraphicsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $alerts = Graphics::all(); // Fetch data from the database
            $view->with('alerts', $alerts); // Share data with all views
        });
    }
}

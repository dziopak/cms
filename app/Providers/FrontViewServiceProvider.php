<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class FrontViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        // Theme data
        $theme = getThemeData();
        view()->composer($theme['url'].'/*', function ($view) use ($theme) {
            $view->with('theme', $theme);
        });

        // 
        
    }
}

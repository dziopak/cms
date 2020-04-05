<?php

namespace App\Providers\ViewComposersProviders;

use Illuminate\Support\ServiceProvider;

class DashboardComposers extends ServiceProvider
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
        view()->composer('admin.dashboard.index', function ($view) {
            if (!$view->dashboard) {
                $view->dashboard = \App\Dashboard::create(['user_id' => $view->user->id]);
            }
            $view->widgets = unserialize($view->dashboard->widgets);
        });
    }
}

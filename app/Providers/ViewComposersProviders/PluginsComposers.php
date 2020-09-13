<?php

namespace App\Providers\ViewComposersProviders;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class PluginsComposers extends ServiceProvider
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
    public function boot(Request $request)
    {
        view()->composer('admin.plugins.index', function ($view) {
            \App\Module::boot();
            $modules['active'] = \App\Module::active();
            $modules['inactive'] = \App\Module::inactive();

            $view->modules = $modules;
            $view->table = getData('Admin/Modules/plugins/plugins_index_table');
        });
    }
}

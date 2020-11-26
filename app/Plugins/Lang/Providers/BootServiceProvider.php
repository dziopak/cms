<?php

namespace App\Plugins\Lang\Providers;

use Illuminate\Support\ServiceProvider;

class BootServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->register(\App\Plugins\Lang\Providers\LangRouteServiceProvider::class);
        $this->app->register(\App\Plugins\Lang\Providers\LangHookServiceProvider::class);
        $file = base_path('\App\Plugins\Lang\Helpers\Functions.php');
        if (file_exists($file)) {
            require_once($file);
        }
    }


    public function boot()
    {
    }
}

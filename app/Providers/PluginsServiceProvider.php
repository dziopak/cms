<?php

namespace App\Providers;

use App\Http\Utilities\Admin\PluginUtilities;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class PluginsServiceProvider extends ServiceProvider
{

    public function register()
    {
    }

    public function boot()
    {
        $dir = 'app\Plugins';

        $plugins = PluginUtilities::readAllManifests();
        foreach ($plugins as $plugin) {
            if ($plugin['active'] === true && is_file(base_path($plugin['boot'] . '.php'))) {
                $this->app->register(ucfirst($plugin['boot']));
            }
        }
    }
}

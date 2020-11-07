<?php

namespace App\Providers;

use App\Http\Utilities\Admin\PluginUtilities;
use Illuminate\Support\ServiceProvider;

class PluginsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        foreach (PluginUtilities::readAllManifests() as $plugin) {
            if ($plugin['active'] === true && is_file(str_replace('\\', '/', base_path($plugin['boot'] . '.php')))) {
                // Register boot provider
                $this->app->register(ucfirst($plugin['boot']));

                // Register lang namespace
                $langPath = str_replace('\\', '/', base_path($plugin['path']) . 'Translations');
                \App::make('translator')->addNamespace(ucfirst($plugin['slug']), $langPath);
            }
        }
    }
}

<?php

namespace App\Http\Utilities\Admin;

use Hook;
use Illuminate\Support\Facades\Route;

class PluginUtilities
{
    public static function readManifest($slug)
    {
        $json = json_decode(file_get_contents(base_path() . "/plugins/" . $slug . "/manifest.json"), true);
        return $json;
    }

    public static function getID($slug)
    {
        $manifest = PluginUtilities::readManifest($slug);
        return $manifest['id'];
    }

    public static function readAllManifests()
    {
        $path = base_path() . '/plugins/';
        $directories = scandir($path);
        $plugins = [];

        foreach ($directories as $dir) {
            if ($dir !== '.' && $dir !== '..') {
                if (is_dir($path . '/' . $dir)) {
                    $plugins[] = PluginUtilities::readManifest($dir);
                }
            }
        }

        return $plugins;
    }


    public static function registerPlugin($slug)
    {
        $manifest = PluginUtilities::readManifest($slug);
        Hook::listen('activePlugins', function ($callback, $output, $plugin) use ($manifest) {
            if (empty($output) || !is_array($output)) $output = [];

            $plugin = new \App\Models\Module;
            $plugin->slug = $manifest['slug'];
            $plugin->id = $manifest['id'];
            $plugin->name = $manifest['name'];
            $plugin->description = $manifest['description'];

            $output[] = $plugin;

            return $output;
        }, $manifest['id']);
    }


    public static function registerRoutes($slug, $controller = null)
    {
        if ($controller === null) $controller = ucfirst($slug) . 'Controller';

        Route::group(['prefix' => 'admin/plugins/' . $slug, 'as' => 'admin.plugins.' . $slug . '.', 'middleware' => 'access:ADMIN_VIEW'], function () use ($slug, $controller) {
            Route::get('/', $controller . '@index')->name('index');
        });
    }
}

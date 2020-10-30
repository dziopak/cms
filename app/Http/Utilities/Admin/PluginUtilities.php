<?php

namespace App\Http\Utilities\Admin;

use Hook;
use Illuminate\Support\Facades\Route;

class PluginUtilities
{

    static function getManifestPath($slug)
    {
        return base_path("app/Plugins/" . $slug . "/manifest.json");
    }


    public static function readManifest($slug)
    {
        $json = json_decode(file_get_contents(self::getManifestPath($slug)), true);
        return $json;
    }

    public static function getID($slug)
    {
        $manifest = PluginUtilities::readManifest($slug);
        return $manifest['id'];
    }

    public static function readAllManifests()
    {
        $path = base_path('app/Plugins/');
        $directories = scandir($path);
        $plugins = [];

        foreach ($directories as $dir) {
            if ($dir !== '.' && $dir !== '..') {
                if (is_dir($path . '/' . $dir)) {
                    $data = self::readManifest($dir);
                    $data['path'] = 'app\Plugins\\' . ucfirst($data['slug']) . '\\';
                    $data['boot'] = $data['path'] . 'Providers\BootServiceProvider';
                    $plugins[$data['id']] = $data;
                }
            }
        }

        config([
            'plugins' => $plugins
        ]);

        return $plugins;
    }


    static function active()
    {
        $plugins = config('plugins');
        $res = [];

        foreach ($plugins as $slug => $plugin) {
            if ($plugin['active'] === true) {
                $res[] = $plugin;
            }
        }

        return $res;
    }

    static function inactive()
    {
        $plugins = config('plugins');
        $res = [];

        foreach ($plugins as $slug => $plugin) {
            if (empty($plugin['active']) || $plugin['active'] !== true) {
                $res[] = $plugin;
            }
        }

        return $res;
    }


    static function setStatus($slug, $status)
    {
        $data = self::readManifest($slug);
        $data['active'] = $status;

        if (file_put_contents(self::getManifestPath($slug), json_encode($data, JSON_PRETTY_PRINT))) {
            return true;
        }

        return false;
    }


    // public static function registerPlugin($slug)
    // {
    //     $manifest = PluginUtilities::readManifest($slug);
    //     Hook::listen('activePlugins', function ($callback, $output, $plugin) use ($manifest) {
    //         if (empty($output) || !is_array($output)) $output = [];

    //         $plugin = new \App\Entities\Plugin;
    //         $plugin->slug = $manifest['slug'];
    //         $plugin->id = $manifest['id'];
    //         $plugin->name = $manifest['name'];
    //         $plugin->description = $manifest['description'];

    //         $output[] = $plugin;

    //         return $output;
    //     }, $manifest['id']);
    // }


    // public static function registerRoutes($slug, $controller = null)
    // {
    //     if ($controller === null) $controller = ucfirst($slug) . 'Controller';

    //     Route::group(['prefix' => 'admin/plugins/' . $slug, 'as' => 'admin.plugins.' . $slug . '.', 'middleware' => 'access:ADMIN_VIEW'], function () use ($slug, $controller) {
    //         Route::get('/', $controller . '@index')->name('index');
    //     });
    // }
}

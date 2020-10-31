<?php

namespace App\Http\Utilities\Admin;

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

    static function publishCSS($slug)
    {
        $css_path = base_path('app/Plugins/' . $slug . '/Assets/CSS');
        $css = scandir($css_path);

        foreach ($css as $file) {
            if (is($file, 'css')) {
                copy_to(
                    $css_path . '/' . $file,
                    public_path(strtolower('css\\' . $slug . '\\' . pathinfo($file)['basename']))
                );
            }
        }

        return true;
    }

    static function publishJS($slug)
    {
        $js_path = base_path('app/Plugins/' . $slug . '/Assets/JS');
        $js = scandir($js_path);

        foreach ($js as $file) {
            if (is($file, 'js')) {
                copy_to(
                    $js_path . '/' . $file,
                    public_path(strtolower('js\\' . $slug . '\\' . pathinfo($file)['basename']))
                );
            }
        }

        return true;
    }

    public static function publishAssets($slug)
    {
        $slug = ucfirst($slug);
        self::publishCSS($slug);
        self::publishJS($slug);
    }
}

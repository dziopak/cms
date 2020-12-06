<?php

namespace App\Services\Admin\Plugins;

class PluginService
{
    public function getManifestPath($slug)
    {
        return base_path("app/Plugins/" . ucfirst($slug) . "/manifest.json");
    }


    public function readManifest($slug)
    {
        $manifest = $this->getManifestPath($slug);
        return json_decode(file_get_contents($manifest), true);
    }

    public function getID($slug)
    {
        $manifest = $this->readManifest($slug);
        return $manifest['id'];
    }

    public function readAllManifests()
    {
        $path = base_path('app/Plugins/');
        $directories = scandir($path);
        $plugins = [];

        foreach ($directories as $dir) {
            if ($dir !== '.' && $dir !== '..') {
                if (is_dir($path . '/' . $dir)) {
                    $data = $this->readManifest($dir);
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


    public function active()
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

    public function inactive()
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


    public function setStatus($slug, $status)
    {
        $data = $this->readManifest($slug);
        $data['active'] = $status;
        $manifest = $this->getManifestPath($slug);

        if (file_put_contents($manifest, json_encode($data, JSON_PRETTY_PRINT))) return true;
        return false;
    }

    public function publishCSS($slug)
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

    public function publishJS($slug)
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

    public function publishAssets($slug)
    {
        $slug = ucfirst($slug);
        $this->publishCSS($slug);
        $this->publishJS($slug);
    }
}

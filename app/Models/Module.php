<?php

namespace App\Models;

use App\Http\Utilities\Admin\PluginUtilities;
use Illuminate\Database\Eloquent\Model;
use Hook;


class Module extends Model
{
    protected $table = 'module_settings';

    static function getModulesData($modules)
    {
        $res = Module::whereIn('module_slug', $modules)->get();
        return $res;
    }

    public static function active()
    {
        $plugins = Hook::get('activePlugins', [$plugins = []], function ($plugins) {
            return $plugins;
        });
        return $plugins;
    }

    private function isActive()
    {
        $active = $this->active();

        foreach ($active as $plugin) {
            if ($this->slug === $plugin->slug) {
                return true;
            }
        }

        return false;
    }

    static function inactive()
    {
        $plugins = Module::all();
        $output = [];

        foreach ($plugins as $plugin) {
            if (!$plugin->isActive()) {
                $output[] = $plugin;
            }
        }

        return $output;
    }

    public static function all($columns = null)
    {
        $plugins = PluginUtilities::readAllManifests();
        $output = [];

        foreach ($plugins as $plugin) {
            $obj = new \App\Models\Module;
            $obj->slug = $plugin['slug'];

            $obj->id = $plugin['id'];
            $obj->name = $plugin['name'];
            $obj->description = $plugin['description'];
            $output[] = $obj;
        }

        return $output;
    }
}

<?php

namespace App\Helpers;

class ThemeHelpers
{
    public static function getThemeList()
    {
        $path = base_path() . '/resources/themes/';
        $dir = scandir(base_path() . '/resources/themes');

        $themes = [];
        foreach ($dir as $theme) {
            $theme_path = $path . $theme;
            $manifest = $theme_path . '/theme.json';

            if (is_file($manifest)) {
                $theme = jsonToArray($manifest);
                $themes[$theme['slug']] = $theme['name'];
            }
        }

        return $themes;
    }


    public function boot($layout)
    {
        return view('Theme::partials.grid', ['layout' => $layout]);
    }


    public function getThemeData($slug = null)
    {
        $slug = ThemeHelpers::activeTheme();
        $manifest = base_path() . '/resources/themes/' . $slug . '/theme.json';

        if (is_file($manifest)) {
            $json = jsonToArray($manifest);

            $theme = new \stdClass;
            $theme->slug = $json['slug'];
            $theme->url = 'themes.' . $theme->slug;
            $theme->assets_url = "theme/assets/";

            return $theme;
        }

        return false;
    }


    public function getThemePath()
    {
        return '/resources/theme/' . $this->activeTheme() . '/';
    }


    public static function activeTheme()
    {
        return config('global.general.theme') ?? 'default';
    }


    public static function getBlockPath($name, $is_admin = false)
    {
        return 'Theme::blocks.' . $name . '.index';
    }


    public function getAsset($file)
    {
        return '/theme/assets/' . $file;
    }
}

function getAsset($file)
{
    return '/theme/assets/' . $file;
}

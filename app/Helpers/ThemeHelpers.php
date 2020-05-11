<?php

namespace App\Helpers;

class ThemeHelpers
{
    public static function getThemeList()
    {
        $path = base_path() . '/resources/views/themes/';
        $dir = scandir(base_path() . '/resources/views/themes');

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
        return $this->getThemeView('partials.grid', ['layout' => $layout]);
    }

    public function getThemeData($slug = null)
    {
        $slug = ThemeHelpers::activeTheme();
        $manifest = base_path() . '/resources/views/themes/' . $slug . '/theme.json';

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

    public function getThemeView($view, $params = null, $path = false)
    {
        if ($path !== true) {
            return view('themes.' . $this->activeTheme() . '.' . $view, $params);
        } else {
            return 'themes.' . $this->activeTheme() . '.' . $view;
        }
    }

    public function getThemePath()
    {
        return '/resources/views/theme/' . $this->activeTheme() . '/';
    }

    public static function activeTheme()
    {
        return config('global.general.theme') ?? 'default';
    }


    public static function getBlockPath($name, $is_admin = false)
    {
        return 'themes.' . ThemeHelpers::activeTheme() . '.blocks.' . $name . '.index';
    }

    public function getAsset($file)
    {
        return '/theme/assets/' . $file;
    }
}

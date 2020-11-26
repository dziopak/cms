<?php

namespace App\Helpers;

class ThemeHelpers
{

    private $slug;

    public function __construct($slug = null)
    {
        if (empty($slug)) $slug = config('global.general.theme');
        $this->slug = $slug;
    }

    static function getThemeList()
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


    public function getBlocks()
    {
        $data = $this->getManifest();
        return $data['blocks'];
    }


    public function boot($layout)
    {
        return view('Theme::partials.grid', ['layout' => $layout]);
    }


    private function getManifest($slug = null)
    {
        $manifest = base_path() . '/resources/themes/' . $this->slug . '/theme.json';

        if (is_file($manifest)) {
            $json = jsonToArray($manifest);
            return $json;
        }

        return false;
    }


    public function getThemeData()
    {
        $json = $this->getManifest($this->slug);

        $theme = new \stdClass;
        $theme->slug = $json['slug'];
        $theme->url = 'themes.' . $theme->slug;
        $theme->assets_url = "theme/assets/";

        return $theme;
    }


    public function getThemePath()
    {
        return '/resources/theme/' . $this->slug . '/';
    }


    static function activeTheme()
    {
        return config('global.general.theme') ?? 'default';
    }


    static function getBlockPath($name)
    {
        return 'Theme::blocks.' . $name . '.index';
    }
}

<?php

function getThemeList()
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

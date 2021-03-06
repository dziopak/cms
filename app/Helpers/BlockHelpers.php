<?php

use App\Helpers\ThemeHelpers;


function decodeBlockConfig($config)
{
    if (empty($config['block'])) $config['block'] = new stdClass;
    if (empty($config['block']->config)) $config['block']->config = [];
    if (is_string($config['block']->config)) $config['block']->config = unserialize($config['block']->config);

    return $config;
}


function displayAdminBlock($block, $config, $admin_options)
{
    return view('admin.blocks.' . $block, array_merge([
        'config' => $config,
        'key' => randomString(15),
    ], $admin_options));
}

function displayBlock($block, $config, $front_options)
{
    return view('Theme::blocks.' . $block . '.index', [
        'block' => array_merge($config['block']->config, array_merge([
            'title' => $config['block']->title
        ], $front_options))
    ]);
}


function block($block, $config, $admin_options = [], $front_options = [])
{
    if (empty($config['block']->config)) $config['block']->config = [];

    return $config['is_admin'] ?
        displayAdminBlock($block, $config, $admin_options) :
        displayBlock($block, $config, $front_options);
}


function getLayout($layout)
{
    $widgets = $layout->blocks()->orderBy('y')->orderBy('x')->get();

    $blocks = [];
    $merge = [];

    foreach ($widgets as $block) {
        if ($block->height > 1) {
            $merge[$block->y] = $block->y + $block->height;
        }
        $blocks[$block->y][] = $block;
    }


    foreach ($merge as $start => $end) {
        for ($i = $start + 1; $i < $end; $i++) {
            if (!empty($blocks[$i])) {
                $blocks[$start] = array_merge($blocks[$start], $blocks[$i]);
                unset($blocks[$i]);
            }
            if (!empty($merge[$i]) && $merge[$i] > $end) {
                $end = $merge[$i];
            }
        }
    }

    $res = [];
    foreach ($blocks as $key => $row) {
        $res[$key]['container'] = 0;
        foreach ($row as $block) {
            if ($block->container === 1) $res[$key]['container'] = $block->container;
            $res[$key][$block->x]['BLOCKS'][] = $block;
            if (empty($res[$key][$block->x]['COLUMN_WIDTH']) || $res[$key][$block->x]['COLUMN_WIDTH'] < $block->width) {
                $res[$key][$block->x]['COLUMN_WIDTH'] = $block->width;
            }
        }
    }


    return $res;
}

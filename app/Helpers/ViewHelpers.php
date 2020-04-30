<?php

use App\Helpers\ThemeHelpers;

function includeAsJsString($template)
{
    $string = view($template);
    return str_replace("\n", '\n', str_replace('"', '\"', addcslashes(str_replace("\r", '', (string) $string), "\0..\37'\\")));
}

function getPublicPath()
{
    $production = ['dziopak-cms.hol.es'];
    $hostname = $_SERVER['SERVER_NAME'];

    if (in_array($hostname, $production)) {
        return $path = url('/public/');
    } else {
        return $path = url('/');
    }
}

function getView($path, $params = [])
{
    return view('themes.' . config('global.general.theme') . '.' . $path, $params);
}

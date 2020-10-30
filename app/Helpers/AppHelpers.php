<?php

function is_installed()
{
    if (file_exists(base_path("/storage/installed")) && table_exists('settings')) {
        return true;
    } else {
        return false;
    }
}

function db_set()
{
    if (!empty(getenv('DB_DATABASE')) && !empty(getenv('DB_USERNAME')) && !empty(getenv('DB_HOST'))) {
        return true;
    } else {
        return false;
    }
}

function setLang($lang)
{
    if (db_set() && Auth::user()) {
        Auth::user()->fire_events = false;
        Auth::user()->locale = $lang;
        Auth::user()->save();
    }
    session(['locale' => $lang]);
}


function getUrl($id, $type)
{
    $url = '';
    switch ($type) {

        case 'page':
            $url = route('front.pages.show', $id);
            break;

        case 'post':
            $url = route('front.posts.show', $id);
            break;

        default:
            $url = 'Not ready yet.';
            break;
    }
    return $url;
}


function replaceRouteParam($url, $field)
{
    if ($open_tag = strpos($url, '{')) {
        $close_tag = strpos($url, '}');
        $field_name = substr($url, ($open_tag + 1), ($close_tag - $open_tag - 1));
        $search = '#{.*?}#si';
        $url = preg_replace($search, ucfirst(strtolower($field[$field_name])), trim($url));
    }

    return $url;
}

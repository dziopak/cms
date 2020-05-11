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

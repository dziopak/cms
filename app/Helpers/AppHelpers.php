<?php

function is_installed()
{
    if (file_exists(base_path("/storage/installed")) && table_exists('settings')) {
        return true;
    } else {
        return false;
    }
}
function setLang($lang)
{
    if (Auth::user()) {
        Auth::user()->fire_events = false;
        Auth::user()->locale = $lang;
        Auth::user()->save();
    }
    session(['locale' => $lang]);
}

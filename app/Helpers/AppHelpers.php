<?php

use App\Exceptions\NotExistingException;
use Illuminate\Database\Eloquent\Model;

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


function isLang()
{
    return getLang() !== getDefaultLang() ? true : false;
}


function getLang()
{
    return Config::get('app.locale');
}


function getDefaultLang()
{
    return Config::get('app.fallback_locale');
}


function getModel($type)
{
    return 'App\Entities\\' . camelCase($type);
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

        case 'category':
            $url = route('front.category.show', $id);
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


function getAsset($file)
{
    return '/theme/assets/' . $file;
}

function getConfig($category, $variable)
{
    return !empty(config('global')) ? config('global')[$category][$variable] : 1;
}


function flushCache($models = [])
{
    if (!empty($models)) {
        if (!is_array($models)) $models = [$models];
        foreach ($models as $model) {
            $model = '\App\Entities\\' . $model;
            if (method_exists($model, 'flushQueryCache')) {
                $model::flushQueryCache();
            }
        }
    }
}


function dispatchEvent($event, $collection, $callback = null)
{
    $args = func_get_args();

    unset($args[0]);
    unset($args[1]);
    unset($args[2]);

    if (!empty($collection)) {
        if ($collection instanceof Model) {
            event(new $event($collection, ...$args));
        } else {
            foreach ($collection->get() as $item) {
                event(new $event($item, ...$args));
            }
        }

        if (!empty($callback)) {
            $callback();
        }
    }
}


function public_dir()
{
    if (config('app.env') === 'production') {
        $path = base_path() . '/../public_html';
        if (is_dir($path)) {
            return $path;
        }
    }
    return public_path();
}


function isMany()
{
    $arr = explode('.', Route::currentRouteName());
    return (end($arr) === "many") ? true : false;
}

function generateSlug($title)
{
    return strtolower(preg_replace(
        ['/[^\w\s]+/', '/\s+/'],
        ['', '-'],
        $title
    ));
}

function exists($var)
{
    if (empty($var) || count($var) <= 0) throw new NotExistingException();
    return true;
}

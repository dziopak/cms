<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $table = 'module_settings';

    static function getModulesData ($modules) {
        $res = Module::whereIn('module_slug', $modules)->get();
        return $res;
    }
}

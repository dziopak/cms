<?php

namespace App\Factories;

class ActionFactory
{
    static function build($model, $class, $request)
    {
        $action = $request->get('mass_action');
        $items = $model::whereIn('id', $request->get('mass_edit')) ?? [];

        return (new $class($items, $request))->$action();
    }
}

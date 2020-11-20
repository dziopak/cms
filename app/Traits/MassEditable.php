<?php

namespace App\Traits;

use App\Factories\ActionFactory;

trait MassEditable
{
    static function getMassActionsClass()
    {
        $class = get_called_class();
        return (new $class)->massActions;
    }

    static function mass()
    {
        $class = self::getMassActionsClass();
        $current = get_called_class();

        // TO DO //
        if (method_exists($current, 'flushQueryCache')) $current::flushQueryCache();
        // MOVE TO EVENT AFTER MASS ACTION //

        return ActionFactory::build($current, $class, request());
    }
}

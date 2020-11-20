<?php

namespace App\Factories;

class EntityFactory
{
    static function build($class, $item)
    {
        return new $class($item);
    }
}

<?php

namespace App\Factories;

use App\Http\Utilities\Admin\Modules\Files\FileEntity;

class EntityFactory
{
    static function build($class, $item)
    {
        return new $class($item);
    }
}

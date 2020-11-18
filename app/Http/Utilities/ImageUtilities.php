<?php

namespace App\Http\Utilities;

class ImageUtilities
{
    static function getWebp($source)
    {
        $destination = $source . '.webp';

        if (file_exists(public_path($destination))) {
            return $destination;
        }

        return $source;
    }
}

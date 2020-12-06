<?php

namespace App\Services;


class ImageService
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

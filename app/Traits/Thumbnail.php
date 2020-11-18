<?php

namespace App\Traits;

trait Thumbnail
{
    public function getThumbnail()
    {
        return '/images/' . $this->thumbnail->path;
    }
}

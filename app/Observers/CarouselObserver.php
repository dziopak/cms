<?php

namespace App\Observers;

class CarouselObserver
{
    public function deleting($carousel)
    {
        $result = $carousel->files()->detach();
    }
}

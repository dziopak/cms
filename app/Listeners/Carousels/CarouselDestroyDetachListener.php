<?php

namespace App\Listeners\Carousels;

class CarouselDestroyDetachListener
{
    public function handle($event)
    {
        $event->carousel->files()->detach();
    }
}

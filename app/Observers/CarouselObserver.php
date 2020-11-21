<?php

namespace App\Observers;

use App\Events\Carousels\CarouselCreateEvent;
use App\Events\Carousels\CarouselDestroyEvent;
use App\Events\Carousels\CarouselUpdateEvent;

class CarouselObserver
{
    public function created($carousel)
    {
        dispatchEvent(CarouselCreateEvent::class, $carousel);
    }

    public function updated($carousel)
    {
        dispatchEvent(CarouselUpdateEvent::class, $carousel);
    }

    public function deleted($carousel)
    {
        dispatchEvent(CarouselDestroyEvent::class, $carousel);
    }
}

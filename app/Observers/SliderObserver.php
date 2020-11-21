<?php

namespace App\Observers;

use App\Events\Sliders\SliderCreateEvent;
use App\Events\Sliders\SliderDestroyEvent;
use App\Events\Sliders\SliderUpdateEvent;

class SliderObserver
{
    public function created($slider)
    {
        dispatchEvent(SliderCreateEvent::class, $slider);
    }

    public function updated($slider)
    {
        dispatchEvent(SliderUpdateEvent::class, $slider);
    }

    public function deleted($slider)
    {
        dispatchEvent(SliderDestroyEvent::class, $slider);
    }
}

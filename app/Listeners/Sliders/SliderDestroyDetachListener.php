<?php

namespace App\Listeners\Sliders;

class SliderDestroyDetachListener
{
    public function handle($event)
    {
        $event->slider->files()->detach();
    }
}

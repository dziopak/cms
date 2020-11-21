<?php

namespace App\Providers\EventServiceProviders;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use App\Events\Sliders\SliderCreateEvent;
use App\Events\Sliders\SliderUpdateEvent;
use App\Events\Sliders\SliderDestroyEvent;

use App\Listeners\Sliders\SliderCreateLogListener;
use App\Listeners\Sliders\SliderUpdateLogListener;
use App\Listeners\Sliders\SliderDestroyDetachListener;
use App\Listeners\Sliders\SliderDestroyLogListener;


class SliderEventServiceProvider extends ServiceProvider
{

    protected $listen = [
        SliderCreateEvent::class => [
            SliderCreateLogListener::class
        ],
        SliderUpdateEvent::class => [
            SliderUpdateLogListener::class
        ],
        SliderDestroyEvent::class => [
            SliderDestroyDetachListener::class,
            SliderDestroyLogListener::class
        ]
    ];


    public function boot()
    {
        parent::boot();
    }
}

<?php

namespace App\Providers\EventServiceProviders;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use App\Events\Carousels\CarouselCreateEvent;
use App\Events\Carousels\CarouselDestroyEvent;
use App\Events\Carousels\CarouselUpdateEvent;

use App\Listeners\Carousels\CarouselCreateLogListener;
use App\Listeners\Carousels\CarouselUpdateLogListener;
use App\Listeners\Carousels\CarouselDestroyDetachListener;
use App\Listeners\Carousels\CarouselDestroyLogListener;


class CarouselEventServiceProvider extends ServiceProvider
{

    protected $listen = [
        CarouselCreateEvent::class => [
            CarouselCreateLogListener::class
        ],
        CarouselUpdateEvent::class => [
            CarouselUpdateLogListener::class
        ],
        CarouselDestroyEvent::class => [
            CarouselDestroyDetachListener::class,
            CarouselDestroyLogListener::class
        ]
    ];


    public function boot()
    {
        parent::boot();
    }
}

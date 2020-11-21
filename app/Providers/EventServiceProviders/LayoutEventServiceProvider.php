<?php

namespace App\Providers\EventServiceProviders;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use App\Events\Layouts\LayoutCreateEvent;
use App\Events\Layouts\LayoutUpdateEvent;
use App\Events\Layouts\LayoutDestroyEvent;

use App\Listeners\Layouts\LayoutCreateLogListener;
use App\Listeners\Layouts\LayoutUpdateLogListener;
use App\Listeners\Layouts\LayoutDestroyLogListener;


class LayoutEventServiceProvider extends ServiceProvider
{
    protected $listen = [
        LayoutCreateEvent::class => [
            LayoutCreateLogListener::class
        ],
        LayoutUpdateEvent::class => [
            LayoutUpdateLogListener::class
        ],
        LayoutDestroyEvent::class => [
            LayoutDestroyLogListener::class
        ]
    ];


    public function boot()
    {
        parent::boot();
    }
}

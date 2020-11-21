<?php

namespace App\Providers\EventServiceProviders;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use App\Events\Menus\MenuCreateEvent;
use App\Events\Menus\MenuUpdateEvent;
use App\Events\Menus\MenuDestroyEvent;

use App\Listeners\Menus\MenuCreateLogListener;
use App\Listeners\Menus\MenuUpdateLogListener;
use App\Listeners\Menus\MenuDestroyLogListener;


class MenuEventServiceProvider extends ServiceProvider
{

    protected $listen = [
        MenuCreateEvent::class => [
            MenuCreateLogListener::class
        ],
        MenuUpdateEvent::class => [
            MenuUpdateLogListener::class
        ],
        MenuDestroyEvent::class => [
            MenuDestroyLogListener::class
        ]
    ];


    public function boot()
    {
        parent::boot();
    }
}

<?php

namespace App\Providers\EventServiceProviders;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use App\Events\Roles\RoleCreateEvent;
use App\Events\Roles\RoleUpdateEvent;
use App\Events\Roles\RoleDestroyEvent;

use App\Listeners\Roles\RoleCreateLogListener;
use App\Listeners\Roles\RoleUpdateLogListener;
use App\Listeners\Roles\RoleDestroyLogListener;

class RoleEventServiceProvider extends ServiceProvider
{

    protected $listen = [
        RoleCreateEvent::class => [
            RoleCreateLogListener::class
        ],
        RoleUpdateEvent::class => [
            RoleUpdateLogListener::class,
        ],
        RoleDestroyEvent::class => [
            RoleDestroyLogListener::class
        ],
    ];


    public function boot()
    {
        parent::boot();
    }
}

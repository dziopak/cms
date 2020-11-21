<?php

namespace App\Providers\EventServiceProviders;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use App\Events\Categories\CategoryCreateEvent;
use App\Events\Categories\CategoryUpdateEvent;
use App\Events\Categories\CategoryDestroyEvent;

use App\Listeners\Categories\CategoryCreateLogListener;
use App\Listeners\Categories\CategoryUpdateLogListener;
use App\Listeners\Categories\CategoryDestroyLogListener;
use App\Listeners\Categories\CategoryDestroyMenuItemListener;


class CategoryEventServiceProvider extends ServiceProvider
{

    protected $listen = [
        CategoryCreateEvent::class => [
            CategoryCreateLogListener::class
        ],
        CategoryUpdateEvent::class => [
            CategoryUpdateLogListener::class
        ],
        CategoryDestroyEvent::class => [
            CategoryDestroyLogListener::class,
            CategoryDestroyMenuItemListener::class
        ],
    ];


    public function boot()
    {
        parent::boot();
    }
}

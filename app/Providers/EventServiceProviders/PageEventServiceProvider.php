<?php

namespace App\Providers\EventServiceProviders;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use App\Events\Pages\PageCreateEvent;
use App\Events\Pages\PageUpdateEvent;
use App\Events\Pages\PageDestroyEvent;

use App\Listeners\Pages\PageCreateLogListener;
use App\Listeners\Pages\PageUpdateThumbnailListener;
use App\Listeners\Pages\PageUpdateLogListener;
use App\Listeners\Pages\PageDestroyLogListener;
use App\Listeners\Pages\PageDestroyMenuItemListener;


class PageEventServiceProvider extends ServiceProvider
{

    protected $listen = [
        PageCreateEvent::class => [
            PageUpdateThumbnailListener::class,
            PageCreateLogListener::class
        ],
        PageUpdateEvent::class => [
            PageUpdateThumbnailListener::class,
            PageUpdateLogListener::class,
        ],
        PageDestroyEvent::class => [
            PageDestroyLogListener::class,
            PageDestroyMenuItemListener::class
        ],
    ];


    public function boot()
    {
        parent::boot();
    }
}

<?php

namespace App\Providers\EventServiceProviders;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use App\Events\Posts\PostCreateEvent;
use App\Events\Posts\PostUpdateEvent;
use App\Events\Posts\PostDestroyEvent;

use App\Listeners\Posts\PostCreateLogListener;
use App\Listeners\Posts\PostUpdateThumbnailListener;
use App\Listeners\Posts\PostUpdateLogListener;
use App\Listeners\Posts\PostDestroyLogListener;
use App\Listeners\Posts\PostDestroyMenuItemListener;


class PostEventServiceProvider extends ServiceProvider
{

    protected $listen = [
        PostCreateEvent::class => [
            PostUpdateThumbnailListener::class,
            PostCreateLogListener::class
        ],
        PostUpdateEvent::class => [
            PostUpdateThumbnailListener::class,
            PostUpdateLogListener::class,
        ],
        PostDestroyEvent::class => [
            PostDestroyLogListener::class,
            PostDestroyMenuItemListener::class
        ],
    ];


    public function boot()
    {
        parent::boot();
    }
}

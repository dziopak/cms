<?php

namespace App\Providers\EventServiceProviders;

use App\Events\Files\FileCreateEvent;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use App\Events\Files\FileDestroyEvent;
use App\Events\Files\FileUpdateEvent;
use App\Listeners\Files\UnsetRelatedThumbnailsListener;


class FileEventServiceProvider extends ServiceProvider
{

    protected $listen = [
        FileCreateEvent::class => [],
        FileUpdateEvent::class => [],
        FileDestroyEvent::class => [
            UnsetRelatedThumbnailsListener::class
        ],
    ];


    public function boot()
    {
        parent::boot();
    }
}

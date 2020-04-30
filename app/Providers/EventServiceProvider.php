<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

use Modules\Portfolio\Events\PortfolioItemCreateEvent;
use Modules\Portfolio\Events\PortfolioItemUpdateEvent;
use Modules\Portfolio\Events\PortfolioItemDestroyEvent;

use Modules\Portfolio\Listeners\PortfolioItemUpdateThumbnailListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        PortfolioItemUpdateEvent::class => [
            PortfolioItemUpdateThumbnailListener::class,
        ]
    ];

    protected $listenFiles = [
        'CategoriesEvents',
        'PagesEvents',
        'PostsEvents',
        'RolesEvents',
        'UsersEvents',
        'FilesEvents',
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        foreach ($this->listenFiles as $file) {
            $this->listen = array_merge(include('EventServiceProvider/' . $file . '.php'), $this->listen);
        }

        parent::boot();
    }
}

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

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        $this->listen = array_merge(include('EventServiceProvider/CategoriesEventServiceProvider.php'), $this->listen);
        $this->listen = array_merge(include('EventServiceProvider/PagesEventServiceProvider.php'), $this->listen);
        $this->listen = array_merge(include('EventServiceProvider/PostsEventServiceProvider.php'), $this->listen);
        $this->listen = array_merge(include('EventServiceProvider/RolesEventServiceProvider.php'), $this->listen);
        $this->listen = array_merge(include('EventServiceProvider/UsersEventServiceProvider.php'), $this->listen);
        
        parent::boot();
    }
}

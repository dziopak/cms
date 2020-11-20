<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Events\Pages\PageCreateEvent;
use App\Events\Pages\PageUpdateEvent;
use App\Events\Pages\PageDestroyEvent;

use App\Listeners\Pages\PageCreateLogListener;
use App\Listeners\Pages\PageUpdateThumbnailListener;
use App\Listeners\Pages\PageUpdateLogListener;
use App\Listeners\Pages\PageDestroyLogListener;
use App\Listeners\Pages\PageDestroyMenuItemListener;

use App\Events\Categories\CategoryCreateEvent;
use App\Listeners\Categories\CategoryCreateLogListener;

use App\Events\Categories\CategoryUpdateEvent;
use App\Listeners\Categories\CategoryUpdateLogListener;

use App\Events\Categories\CategoryDestroyEvent;
use App\Listeners\Categories\CategoryDestroyLogListener;
use App\Listeners\Categories\CategoryDestroyMenuItemListener;

use App\Events\Files\FileDestroyEvent;
use App\Listeners\Files\UnsetRelatedThumbnailsListener;

use App\Events\Posts\PostCreateEvent;
use App\Events\Posts\PostDestroyEvent;
use App\Events\Posts\PostUpdateEvent;

use App\Listeners\Posts\PostCreateLogListener;
use App\Listeners\Posts\PostUpdateThumbnailListener;
use App\Listeners\Posts\PostUpdateLogListener;
use App\Listeners\Posts\PostDestroyLogListener;
use App\Listeners\Posts\PostDestroyMenuItemListener;

use App\Events\Roles\RoleCreateEvent;
use App\Listeners\Roles\RoleCreateLogListener;

use App\Events\Roles\RoleUpdateEvent;
use App\Listeners\Roles\RoleUpdateLogListener;

use App\Events\Roles\RoleDestroyEvent;
use App\Listeners\Roles\RoleDestroyLogListener;

use App\Events\Users\UserCreateEvent;
use App\Listeners\Users\UserCreateLogListener;

use App\Events\Users\UserUpdateEvent;
use App\Listeners\Users\UserUpdateAvatarListener;
use App\Listeners\Users\UserUpdateLogListener;

use App\Events\Users\UserNewPasswordEvent;
use App\Listeners\Users\UserNewPasswordLogListener;

use App\Events\Users\UserBlockEvent;
use App\Listeners\Users\UserBlockLogListener;

use App\Events\Users\UserDestroyEvent;
use App\Listeners\Users\UserDestroyLogListener;


use App\Events\Carousels\CarouselDestroyEvent;
use App\Listeners\Carousels\CarouselDestroyDetachListener;




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


        FileDestroyEvent::class => [
            UnsetRelatedThumbnailsListener::class
        ],


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


        RoleCreateEvent::class => [
            RoleCreateLogListener::class
        ],
        RoleUpdateEvent::class => [
            RoleUpdateLogListener::class,
        ],
        RoleDestroyEvent::class => [
            RoleDestroyLogListener::class
        ],


        UserCreateEvent::class => [
            UserUpdateAvatarListener::class,
            UserCreateLogListener::class
        ],
        UserUpdateEvent::class => [
            UserUpdateAvatarListener::class,
            UserUpdateLogListener::class,
        ],
        UserNewPasswordEvent::class => [
            UserNewPasswordLogListener::class,
        ],
        UserDestroyEvent::class => [
            UserDestroyLogListener::class
        ],
        UserBlockEvent::class => [
            UserBlockLogListener::class
        ],

        CarouselDestroyEvent::class => [
            CarouselDestroyDetachListener::class
        ]

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}

<?php

namespace App\Providers\EventServiceProviders;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;


use Illuminate\Auth\Events\Registered;
use App\Events\Users\UserCreateEvent;
use App\Events\Users\UserUpdateEvent;
use App\Events\Users\UserNewPasswordEvent;
use App\Events\Users\UserBlockEvent;
use App\Events\Users\UserDestroyEvent;

use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use App\Listeners\Users\UserCreateLogListener;
use App\Listeners\Users\UserUpdateAvatarListener;
use App\Listeners\Users\UserUpdateLogListener;
use App\Listeners\Users\UserNewPasswordLogListener;
use App\Listeners\Users\UserBlockLogListener;
use App\Listeners\Users\UserDestroyLogListener;


class UserEventServiceProvider extends ServiceProvider
{

    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
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
    ];


    public function boot()
    {
        parent::boot();
    }
}

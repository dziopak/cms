<?php
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
    
    return [
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
        ]
    ]
?>
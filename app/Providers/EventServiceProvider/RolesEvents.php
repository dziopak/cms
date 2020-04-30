<?php
    use App\Events\Roles\RoleCreateEvent;
    use App\Listeners\Roles\RoleCreateLogListener;

    use App\Events\Roles\RoleUpdateEvent;
    use App\Listeners\Roles\RoleUpdateLogListener;

    use App\Events\Roles\RoleDestroyEvent;
    use App\Listeners\Roles\RoleDestroyLogListener;
    
    return [
        RoleCreateEvent::class => [
            RoleCreateLogListener::class
        ],
        RoleUpdateEvent::class => [
            RoleUpdateLogListener::class,
        ],
        RoleDestroyEvent::class => [
            RoleDestroyLogListener::class
        ]
    ]
?>
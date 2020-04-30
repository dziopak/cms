<?php
    use App\Events\Categories\CategoryCreateEvent;
    use App\Listeners\Categories\CategoryCreateLogListener;

    use App\Events\Categories\CategoryUpdateEvent;
    use App\Listeners\Categories\CategoryUpdateLogListener;

    use App\Events\Categories\CategoryDestroyEvent;
    use App\Listeners\Categories\CategoryDestroyLogListener;
    
    return [
        CategoryCreateEvent::class => [
            CategoryCreateLogListener::class
        ],

        CategoryUpdateEvent::class => [
            CategoryUpdateLogListener::class
        ],

        CategoryDestroyEvent::class => [
            CategoryDestroyLogListener::class
        ]
    ]
?>
<?php
    use App\Events\Posts\PostCreateEvent;
    use App\Listeners\Posts\PostCreateLogListener;

    use App\Events\Posts\PostUpdateEvent;
    use App\Listeners\Posts\PostUpdateThumbnailListener;
    use App\Listeners\Posts\PostUpdateLogListener;

    use App\Events\Posts\PostDestroyEvent;
    use App\Listeners\Posts\PostDestroyLogListener;
    
    return [
        PostCreateEvent::class => [
            PostUpdateThumbnailListener::class,
            PostCreateLogListener::class
        ],
        PostUpdateEvent::class => [
            PostUpdateThumbnailListener::class,
            PostUpdateLogListener::class,
        ],
        PostDestroyEvent::class => [
            PostDestroyLogListener::class
        ]
    ]
?>
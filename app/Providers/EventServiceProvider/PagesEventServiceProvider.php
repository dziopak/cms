<?php
    use App\Events\Pages\PageCreateEvent;
    use App\Listeners\Pages\PageCreateLogListener;

    use App\Events\Pages\PageUpdateEvent;
    use App\Listeners\Pages\PageUpdateThumbnailListener;
    use App\Listeners\Pages\PageUpdateLogListener;

    use App\Events\Pages\PageDestroyEvent;
    use App\Listeners\Pages\PageDestroyLogListener;
    
    return [
        PageCreateEvent::class => [
            PageUpdateThumbnailListener::class,
            PageCreateLogListener::class
        ],
        PageUpdateEvent::class => [
            PageUpdateThumbnailListener::class,
            PageUpdateLogListener::class,
        ],
        PageDestroyEvent::class => [
            PageDestroyLogListener::class
        ]
    ]
?>
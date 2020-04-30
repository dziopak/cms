<?php

use App\Events\Files\FileDestroyEvent;
use App\Listeners\Files\UnsetRelatedThumbnailsListener;


return [
    FileDestroyEvent::class => [
        UnsetRelatedThumbnailsListener::class
    ]
];

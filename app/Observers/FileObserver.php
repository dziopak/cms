<?php

namespace App\Observers;

use App\Events\Files\FileCreateEvent;
use App\Events\Files\FileDestroyEvent;
use App\Events\Files\FileUpdateEvent;

class FileObserver
{
    public function created($file)
    {
        dispatchEvent(FileCreateEvent::class, $file);
    }

    public function updated($file)
    {
        dispatchEvent(FileUpdateEvent::class, $file);
    }

    public function deleted($file)
    {
        dispatchEvent(FileDestroyEvent::class, $file);
    }
}

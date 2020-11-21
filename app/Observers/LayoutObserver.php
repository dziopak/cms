<?php

namespace App\Observers;

use App\Events\Layouts\LayoutCreateEvent;
use App\Events\Layouts\LayoutDestroyEvent;
use App\Events\Layouts\LayoutUpdateEvent;

class LayoutObserver
{
    public function created($layout)
    {
        dispatchEvent(LayoutCreateEvent::class, $layout);
    }

    public function updated($layout)
    {
        dispatchEvent(LayoutUpdateEvent::class, $layout);
    }

    public function deleted($layout)
    {
        dispatchEvent(LayoutDestroyEvent::class, $layout);
    }
}

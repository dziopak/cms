<?php

namespace App\Observers;

use App\Events\Menus\MenuCreateEvent;
use App\Events\Menus\MenuDestroyEvent;
use App\Events\Menus\MenuUpdateEvent;

class MenuObserver
{
    public function created($menu)
    {
        dispatchEvent(MenuCreateEvent::class, $menu);
    }

    public function updated($menu)
    {
        dispatchEvent(MenuUpdateEvent::class, $menu);
    }

    public function deleted($menu)
    {
        dispatchEvent(MenuDestroyEvent::class, $menu);
    }
}

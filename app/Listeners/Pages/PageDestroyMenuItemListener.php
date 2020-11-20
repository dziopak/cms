<?php

namespace App\Listeners\Pages;

use App\Entities\MenuItem;

class PageDestroyMenuItemListener
{
    public function handle($event)
    {
        MenuItem::where([
            'model_type' => 'page',
            'model_id' => $event->page->id
        ])->delete();
    }
}

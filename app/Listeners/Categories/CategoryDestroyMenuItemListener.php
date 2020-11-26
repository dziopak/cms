<?php

namespace App\Listeners\Categories;

use App\Entities\MenuItem;

class CategoryDestroyMenuItemListener
{
    public function handle($event)
    {
        MenuItem::where([
            'model_type' => 'category',
            'model_id' => $event->category->id
        ])->delete();
    }
}

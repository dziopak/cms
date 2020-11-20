<?php

namespace App\Listeners\Categories;

use App\Entities\MenuItem;
use Illuminate\Database\Eloquent\Model;

class CategoryDestroyMenuItemListener
{
    public function handle($event)
    {
        MenuItem::where([
            'model_type' => strtolower($event->type) . '_category',
            'model_id' => $event->category->id
        ])->delete();
    }
}

<?php

namespace App\Listeners\Posts;

use App\Entities\MenuItem;

class PostDestroyMenuItemListener
{
    public function handle($event)
    {
        MenuItem::where([
            'model_type' => 'post',
            'model_id' => $event->post->id
        ])->delete();
    }
}

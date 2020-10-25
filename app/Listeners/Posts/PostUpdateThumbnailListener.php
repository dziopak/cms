<?php

namespace App\Listeners\Posts;

use App\Models\File;

class PostUpdateThumbnailListener
{

    public function handle($event)
    {
        if ($event->thumbnail) {
            $name = time() . '_' . $event->thumbnail->getClientOriginalName();
            $event->thumbnail->move('images/thumbnails', $name);

            $photo = File::create(['path' => 'thumbnails/' . $name, 'type' => '1']);
            $event->post->fire_events = false;
            $event->post->update(['file_id' => $photo->id]);
        }
    }
}

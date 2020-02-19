<?php

namespace App\Listeners\Posts;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\File;

class PostUpdateThumbnailListener
{
    
    public function handle($event)
    {
        if ($event->thumbnail) {
            $name = time(). '_' .$event->thumbnail->getClientOriginalName();
            $event->thumbnail->move('images/thumbnails', $name);
            
            $photo = File::create(['path' => 'thumbnails/'.$name, 'type' => '1']);
            $event->post->update(['file_id' => $photo->id]);
        }
    }

}

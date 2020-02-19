<?php

namespace App\Listeners\Pages;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\File;

class PageUpdateThumbnailListener
{

    public function handle($event)
    {
        if ($event->thumbnail) {
            $name = time(). '_' .$event->thumbnail->getClientOriginalName();
            $event->thumbnail->move('images/thumbnails', $name);
            
            $photo = File::create(['path' => 'thumbnails/'.$name, 'type' => '1']);
            $event->page->update(['file_id' => $photo->id]);
        }
    }
}

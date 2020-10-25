<?php

namespace plugins\Portfolio\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\File;
use plugins\Portfolio\Entities\PortfolioItem;

class PortfolioItemUpdateThumbnailListener
{
    public function handle($event)
    {
        if ($event->thumbnail) {
            $name = time() . '_' . $event->thumbnail->getClientOriginalName();
            $event->thumbnail->move('images/thumbnails', $name);

            $photo = File::create(['path' => 'thumbnails/' . $name, 'type' => '1']);
            $event->item->fire_events = false;
            $event->item->update(['file_id' => $photo->id]);
        }
    }
}

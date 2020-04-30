<?php

namespace App\Listeners\Files;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UnsetRelatedThumbnailsListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $file = $event->file;
        foreach ($file->getRelated() as $related) {
            $related->fire_events = false;
            $related->update(['file_id' => null, 'avatar' => null]);
        }
    }
}

<?php

namespace App\Listeners\Files;

class UnsetRelatedThumbnailsListener
{
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

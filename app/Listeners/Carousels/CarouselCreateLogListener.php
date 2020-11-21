<?php

namespace App\Listeners\Carousels;

use App\Entities\Log;
use Auth;

class CarouselCreateLogListener
{

    public function handle($event)
    {
        $log_data = [
            'user_id' => Auth::user()->id,
            'target_id' => $event->carousel->id,
            'target_name' => $event->carousel->name,
            'type' => 'CAROUSEL',
            'crud_action' => '1',
            'message' => 'created new carousel'
        ];

        Log::create($log_data);
    }
}

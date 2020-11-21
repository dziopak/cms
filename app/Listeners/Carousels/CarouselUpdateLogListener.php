<?php

namespace App\Listeners\Carousels;

use App\Entities\Log;
use Auth;

class CarouselUpdateLogListener
{

    public function handle($event)
    {
        $log_data = [
            'user_id' => Auth::user()->id,
            'target_id' => $event->carousel->id,
            'target_name' => $event->carousel->name,
            'type' => 'CAROUSEL',
            'crud_action' => '2',
            'message' => 'edited carousel'
        ];
        Log::create($log_data);
    }
}

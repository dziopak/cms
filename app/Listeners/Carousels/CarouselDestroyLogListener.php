<?php

namespace App\Listeners\Carousels;

use App\Entities\Log;
use Auth;

class CarouselDestroyLogListener
{

    public function handle($event)
    {
        $log_data = [
            'user_id' => Auth::user()->id,
            'target_id' => 0,
            'target_name' => $event->carousel->name,
            'type' => 'CAROUSEL',
            'crud_action' => '3',
            'message' => 'deleted carousel'
        ];
        Log::create($log_data);
    }
}

<?php

namespace App\Listeners\Sliders;

use App\Entities\Log;
use Auth;

class SliderDestroyLogListener
{

    public function handle($event)
    {
        $log_data = [
            'user_id' => Auth::user()->id,
            'target_id' => 0,
            'target_name' => $event->slider->name,
            'type' => 'SLIDER',
            'crud_action' => '3',
            'message' => 'deleted slider'
        ];
        Log::create($log_data);
    }
}

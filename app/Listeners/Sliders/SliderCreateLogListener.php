<?php

namespace App\Listeners\Sliders;

use App\Entities\Log;
use Auth;

class SliderCreateLogListener
{

    public function handle($event)
    {
        $log_data = [
            'user_id' => Auth::user()->id,
            'target_id' => $event->slider->id,
            'target_name' => $event->slider->name,
            'type' => 'SLIDER',
            'crud_action' => '1',
            'message' => 'created new slider'
        ];

        Log::create($log_data);
    }
}

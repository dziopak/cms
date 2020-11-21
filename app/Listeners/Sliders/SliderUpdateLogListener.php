<?php

namespace App\Listeners\Sliders;

use App\Entities\Log;
use Auth;

class SliderUpdateLogListener
{

    public function handle($event)
    {
        $log_data = [
            'user_id' => Auth::user()->id,
            'target_id' => $event->slider->id,
            'target_name' => $event->slider->name,
            'type' => 'SLIDER',
            'crud_action' => '2',
            'message' => 'edited slider'
        ];
        Log::create($log_data);
    }
}

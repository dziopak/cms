<?php

namespace App\Listeners\Layouts;

use App\Entities\Log;
use Auth;

class LayoutCreateLogListener
{

    public function handle($event)
    {
        $log_data = [
            'user_id' => Auth::user()->id,
            'target_id' => $event->layout->id,
            'target_name' => $event->layout->name,
            'type' => 'LAYOUT',
            'crud_action' => '1',
            'message' => 'created new layout'
        ];

        Log::create($log_data);
    }
}

<?php

namespace App\Listeners\Layouts;

use App\Entities\Log;
use Auth;

class LayoutUpdateLogListener
{

    public function handle($event)
    {
        $log_data = [
            'user_id' => Auth::user()->id,
            'target_id' => $event->layout->id,
            'target_name' => $event->layout->name,
            'type' => 'LAYOUT',
            'crud_action' => '2',
            'message' => 'edited layout'
        ];
        Log::create($log_data);
    }
}

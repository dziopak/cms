<?php

namespace App\Listeners\Layouts;

use App\Entities\Log;
use Auth;

class LayoutDestroyLogListener
{

    public function handle($event)
    {
        $log_data = [
            'user_id' => Auth::user()->id,
            'target_id' => 0,
            'target_name' => $event->layout->name,
            'type' => 'LAYOUT',
            'crud_action' => '3',
            'message' => 'deleted layout'
        ];
        Log::create($log_data);
    }
}

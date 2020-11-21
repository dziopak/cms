<?php

namespace App\Listeners\Menus;

use App\Entities\Log;
use Auth;

class MenuDestroyLogListener
{

    public function handle($event)
    {
        $log_data = [
            'user_id' => Auth::user()->id,
            'target_id' => 0,
            'target_name' => $event->menu->name,
            'type' => 'MENU',
            'crud_action' => '3',
            'message' => 'deleted menu'
        ];
        Log::create($log_data);
    }
}

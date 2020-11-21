<?php

namespace App\Listeners\Menus;

use App\Entities\Log;
use Auth;

class MenuCreateLogListener
{

    public function handle($event)
    {
        $log_data = [
            'user_id' => Auth::user()->id,
            'target_id' => $event->menu->id,
            'target_name' => $event->menu->name,
            'type' => 'MENU',
            'crud_action' => '1',
            'message' => 'created new menu'
        ];

        Log::create($log_data);
    }
}

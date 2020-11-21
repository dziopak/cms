<?php

namespace App\Listeners\Menus;

use App\Entities\Log;
use Auth;

class MenuUpdateLogListener
{
    public function handle($event)
    {
        $log_data = [
            'user_id' => Auth::user()->id,
            'target_id' => $event->menu->id,
            'target_name' => $event->menu->name,
            'type' => 'MENU',
            'crud_action' => '2',
            'message' => 'edited menu'
        ];
        Log::create($log_data);
    }
}

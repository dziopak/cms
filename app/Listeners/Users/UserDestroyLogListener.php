<?php

namespace App\Listeners\Users;

use App\Log;
use Auth;

class UserDestroyLogListener
{

    public function handle($event)
    {
        $log_data = [
            'user_id' => Auth::user()->id,
            'target_id' => '0',
            'target_name' => $event->user->name,
            'type' => 'USER',
            'crud_action' => '3',
            'message' => 'deleted account of '
        ];
        Log::create($log_data);
    }
}

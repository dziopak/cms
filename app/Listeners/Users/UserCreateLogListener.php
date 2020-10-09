<?php

namespace App\Listeners\Users;

use App\Log;
use Auth;

class UserCreateLogListener
{

    public function handle($event)
    {
        if (Auth::user()) {
            $log_data = [
                'user_id' => Auth::user()->id,
                'target_id' => $event->user->id,
                'target_name' => $event->user->name,
                'type' => 'USER',
                'crud_action' => '1',
                'message' => 'created new user'
            ];
            Log::create($log_data);
        }
    }
}

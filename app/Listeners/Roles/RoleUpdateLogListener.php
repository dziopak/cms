<?php

namespace App\Listeners\Roles;

use App\Entities\Log;
use Auth;

class RoleUpdateLogListener
{

    public function handle($event)
    {
        $log_data = [
            'user_id' => Auth::user()->id,
            'target_id' => $event->role->id,
            'target_name' => $event->role->name,
            'type' => 'ROLE',
            'crud_action' => '2',
            'message' => 'updated access role'
        ];

        Log::create($log_data);
    }
}

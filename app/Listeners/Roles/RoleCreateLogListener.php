<?php

namespace App\Listeners\Roles;

use App\Models\Log;
use Auth;

class RoleCreateLogListener
{

    public function handle($event)
    {
        $log_data = [
            'user_id' => Auth::user()->id,
            'target_id' => $event->role->id,
            'target_name' => $event->role->name,
            'type' => 'ROLE',
            'crud_action' => '1',
            'message' => 'created access role'
        ];
        Log::create($log_data);
    }
}

<?php

namespace App\Listeners\Roles;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Log;
use Auth;

class RoleDestroyLogListener
{
    
    public function handle($event)
    {
        $log_data = [
            'user_id' => Auth::user()->id,
            'target_id' => '0',
            'target_name' => $event->role->name,
            'type' => 'ROLE',
            'crud_action' => '3',
            'message' => 'deleted access role'
        ];
        
        Log::create($log_data);
    }

}

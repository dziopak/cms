<?php

namespace App\Listeners\Users;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Log;
use Auth;

class UserBlockLogListener
{
    
    public function handle($event)
    {
        $log_data = [
            'user_id' => Auth::user()->id,
            'target_id' => $event->user->id,
            'target_name' => $event->user->name,
            'type' => 'USER',
            'crud_action' => '2',
            'message' => $event->user->is_active == 1 ? 'unblocked user' : 'blocked user'
        ];
        Log::create($log_data);
    }

}

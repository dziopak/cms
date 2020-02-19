<?php

namespace App\Listeners\Users;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Log;
use Auth;

class UserNewPasswordLogListener
{
 
    public function handle($event)
    {
        $log_data = [
            'user_id' => Auth::user()->id,
            'target_id' => $event->user->id,
            'target_name' => $event->user->name,
            'type' => 'USER',
            'crud_action' => '2',
            'message' => 'changed password of user'
        ];
        Log::create($log_data);
    }

}

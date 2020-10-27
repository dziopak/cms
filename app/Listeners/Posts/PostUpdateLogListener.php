<?php

namespace App\Listeners\Posts;

use App\Entities\Log;
use Auth;

class PostUpdateLogListener
{

    public function handle($event)
    {
        $log_data = [
            'user_id' => Auth::user()->id,
            'target_id' => $event->post->id,
            'target_name' => $event->post->name,
            'type' => 'POST',
            'crud_action' => '2',
            'message' => 'edited post'
        ];
        Log::create($log_data);
    }
}

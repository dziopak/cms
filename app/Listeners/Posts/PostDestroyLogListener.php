<?php

namespace App\Listeners\Posts;

use App\Models\Log;
use Auth;

class PostDestroyLogListener
{

    public function handle($event)
    {
        $log_data = [
            'user_id' => Auth::user()->id,
            'target_id' => 0,
            'target_name' => $event->post->name,
            'type' => 'POST',
            'crud_action' => '3',
            'message' => 'deleted post'
        ];
        Log::create($log_data);
    }
}

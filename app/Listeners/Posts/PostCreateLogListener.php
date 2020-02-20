<?php

namespace App\Listeners\Posts;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Log;

class PostCreateLogListener
{
    
    public function handle($event)
    {
        $log_data = [
            'user_id' => $event->post->user_id,
            'target_id' => $event->post->id,
            'target_name' => $event->post->name,
            'type' => 'POST',
            'crud_action' => '1',
            'message' => 'created new post'
        ];

        Log::create($log_data);
    }

}
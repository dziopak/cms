<?php

namespace App\Listeners\Posts;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Log;
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
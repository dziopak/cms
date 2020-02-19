<?php

namespace App\Listeners\Pages;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Log;
use Auth;

class PageDestroyLogListener
{
    
    public function handle($event)
    {
        $log_data = [
            'user_id' => Auth::user()->id,
            'target_id' => $event->page->id,
            'target_name' => $event->page->name,
            'type' => 'PAGE',
            'crud_action' => '3',
            'message' => 'deleted page'
        ];
        Log::create($log_data);
    }

}

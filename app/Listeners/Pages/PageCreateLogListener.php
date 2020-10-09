<?php

namespace App\Listeners\Pages;

use App\Log;

class PageCreateLogListener
{

    public function handle($event)
    {
        $log_data = [
            'user_id' => $event->page->user_id,
            'target_id' => $event->page->id,
            'target_name' => $event->page->name,
            'type' => 'PAGE',
            'crud_action' => '1',
            'message' => 'created new page'
        ];

        Log::create($log_data);
    }
}

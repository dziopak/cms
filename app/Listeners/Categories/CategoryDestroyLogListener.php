<?php

namespace App\Listeners\Categories;

use App\Entities\Log;
use Auth;

class CategoryDestroyLogListener
{
    public function handle($event)
    {
        $log_data = [
            'user_id' => Auth::user()->id,
            'target_id' => 0,
            'target_name' => $event->category->name,
            'type' => $event->type . '_CATEGORY',
            'crud_action' => '3',
            'message' => 'deleted ' . strtolower($event->type) . ' category'
        ];

        Log::create($log_data);
    }
}

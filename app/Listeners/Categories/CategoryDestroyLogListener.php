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
            'type' => 'CATEGORY',
            'crud_action' => '3',
            'message' => 'deleted category'
        ];

        Log::create($log_data);
    }
}

<?php

namespace App\Listeners\Categories;

use App\Entities\Log;
use Auth;

class CategoryCreateLogListener
{

    public function handle($event)
    {
        $log_data = [
            'user_id' => Auth::user()->id,
            'target_id' => $event->category->id,
            'target_name' => $event->category->name,
            'type' => 'CATEGORY',
            'crud_action' => '1',
            'message' => 'created category'
        ];

        Log::create($log_data);
    }
}

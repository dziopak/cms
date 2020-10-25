<?php

namespace App\Listeners\Categories;

use App\Models\Log;
use Auth;

class CategoryCreateLogListener
{

    public function handle($event)
    {
        $log_data = [
            'user_id' => Auth::user()->id,
            'target_id' => $event->category->id,
            'target_name' => $event->category->name,
            'type' => $event->type . '_CATEGORY',
            'crud_action' => '1',
            'message' => 'created ' . strtolower($event->type) . ' category'
        ];

        Log::create($log_data);
    }
}

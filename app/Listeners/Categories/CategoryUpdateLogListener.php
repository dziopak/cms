<?php

namespace App\Listeners\Categories;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Log;
use Auth;

class CategoryUpdateLogListener
{
    
    public function handle($event)
    {
        $log_data = [
            'user_id' => Auth::user()->id,
            'target_id' => $event->category->id,
            'target_name' => $event->category->name,
            'type' => $event->type.'_CATEGORY',
            'crud_action' => '2',
            'message' => 'updated '.strtolower($event->type).' category'
        ];

        Log::create($log_data);
    }
}

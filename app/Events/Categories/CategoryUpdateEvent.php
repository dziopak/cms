<?php

namespace App\Events\Categories;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CategoryUpdateEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $category;


    public function __construct($category)
    {
        $this->category = $category;
    }


    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}

<?php

namespace App\Events\Categories;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CategoryCreateEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $category;
    public $type;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($category, $type)
    {
        $this->category = $category;
        $this->type = $type;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}

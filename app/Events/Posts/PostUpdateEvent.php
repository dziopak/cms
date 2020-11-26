<?php

namespace App\Events\Posts;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PostUpdateEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $post;
    public $thumbnail;

    public function __construct($post, $thumbnail = null)
    {
        $this->post = $post;
        $this->thumbnail = $thumbnail;
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

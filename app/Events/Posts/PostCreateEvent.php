<?php

namespace App\Events\Posts;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PostCreateEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $post;
    public $thumbnail;

    public function __construct($post, $thumbnail)
    {
        $this->post = $post;
        $this->thumbnail = $thumbnail;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}

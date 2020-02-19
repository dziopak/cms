<?php

namespace App\Events\Posts;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PostDestroyEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $post;

    public function __construct($post)
    {
        $this->post = $post;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}

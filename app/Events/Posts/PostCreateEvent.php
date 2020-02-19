<?php

namespace App\Events\Posts;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
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

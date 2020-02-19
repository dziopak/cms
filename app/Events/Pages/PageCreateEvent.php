<?php

namespace App\Events\Pages;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PageCreateEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $page;
    public $thumbnail;

    public function __construct($page, $thumbnail)
    {
        $this->page = $page;
        $this->thumbnail = $thumbnail;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}

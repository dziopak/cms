<?php

namespace App\Events\Pages;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PageDestroyEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $page;

    public function __construct($page)
    {
        $this->page = $page;
    }


    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}

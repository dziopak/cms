<?php

namespace App\Events\Pages;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PageUpdateEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $page;
    public $thumbnail;


    public function __construct($page, $thumbnail = null)
    {
        $this->page = $page;
        $this->thumbnail = $thumbnail;
    }


    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}

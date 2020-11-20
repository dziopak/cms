<?php

namespace App\Events\Layouts;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LayoutUpdateEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $layout;


    public function __construct($layout = null)
    {
        $this->layout = $layout;
    }


    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}

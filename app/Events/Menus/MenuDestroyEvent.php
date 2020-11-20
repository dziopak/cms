<?php

namespace App\Events\Menus;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MenuDestroyEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $menu;


    public function __construct($menu = null)
    {
        $this->menu = $menu;
    }


    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}

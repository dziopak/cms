<?php

namespace App\Events\Carousels;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CarouselCreateEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $carousel;


    public function __construct($carousel = null)
    {
        $this->carousel = $carousel;
    }


    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}

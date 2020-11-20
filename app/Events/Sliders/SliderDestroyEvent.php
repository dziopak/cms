<?php

namespace App\Events\Sliders;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SliderDestroyEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $slider;


    public function __construct($slider = null)
    {
        $this->slider = $slider;
    }


    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}

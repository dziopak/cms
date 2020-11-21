<?php

namespace App\Events\Settings;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SettingsUpdateEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $settings;


    public function __construct($settings = null)
    {
        $this->settings = $settings;
    }


    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}

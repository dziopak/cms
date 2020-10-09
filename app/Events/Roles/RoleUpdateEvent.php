<?php

namespace App\Events\Roles;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RoleUpdateEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $role;

    public function __construct($role)
    {
        $this->role = $role;
    }


    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}

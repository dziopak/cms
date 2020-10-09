<?php

namespace App\Events\Users;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserUpdateEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $avatar;

    public function __construct($user, $avatar)
    {
        $this->user = $user;
        $this->avatar = $avatar;
    }


    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}

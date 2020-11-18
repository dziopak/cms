<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\UserPasswordReset as UserPasswordResetMailable;

class UserPasswordReset extends Notification implements ShouldQueue
{
    use Queueable;

    protected $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function via($notifiable)
    {
        return ["mail"];
    }

    public function toMail($notifiable)
    {
        return new UserPasswordResetMailable($this->url, $notifiable);
    }
}

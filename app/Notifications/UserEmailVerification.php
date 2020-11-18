<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Mail\UserEmailVerification as UserEmailVerificationMailable;

class UserEmailVerification extends Notification implements ShouldQueue
{
    use Queueable;
    protected $url;

    public function __construct($url)
    {
        $this->url = $url;
    }


    public function via($notifiable)
    {
        return ['mail'];
    }


    public function toMail($notifiable)
    {
        return new UserEmailVerificationMailable($this->url, $notifiable);
    }
}

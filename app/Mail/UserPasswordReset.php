<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserPasswordReset extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    protected $url;
    protected $user;


    public function __construct($url, $user)
    {
        $this->url = $url;
        $this->user = $user;
    }


    public function build()
    {
        $address = 'noreply@' . config('app.domain');
        $name = 'Michał Dziopak';
        $subject = config('app.name') . ' - Próba zresetowania hasła';

        return $this->to($this->user)->subject($subject)->from($address, $name)->markdown('emails.password_reset', ['url' => $this->url, 'user' => $this->user]);
    }
}

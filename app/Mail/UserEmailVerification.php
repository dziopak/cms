<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class UserEmailVerification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public $verifyUrl;
    protected $user;


    public function __construct($url, $user)
    {
        $this->verifyUrl = $url;
        $this->user = $user;
    }


    public function build()
    {
        $address = 'noreply@' . config('app.domain');
        $name = 'Michał Dziopak';
        $subject = config('app.name') . ' - weryfikacja konta ' . $this->user->name;
        return $this->to($this->user)->subject($subject)->from($address, $name)->markdown('emails.verify', ['url' => $this->verifyUrl, 'user' => $this->user]);
    }
}

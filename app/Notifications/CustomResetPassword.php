<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CustomResetPassword extends Notification
{
    use Queueable;

    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        // Ye wo secure link hai jis par click kar ke user password change karega
        $url = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        // Yahan hum apna VIP design attach kar rahay hain
        return (new MailMessage)
            ->subject('Secure Access: Reset Your DriveElite Password')
            ->view('emails.vip_reset_password', ['url' => $url, 'user' => $notifiable]);
    }
}
<?php

namespace App\Domains\Auth\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ForgotPasswordNotification extends Notification
{
    private string $password;

    public function __construct(string $password)
    {
        $this->password = $password;
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Your New Password')
            ->greeting('Hello Dear User,')
            ->line('Your password has been reset. Here is your new password:')
            ->line($this->password)
            ->line('Please login and change it to something more secure.');
    }

    public function toArray($notifiable): array
    {
        return [];
    }
}

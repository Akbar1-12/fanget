<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    public function __construct(
        public string $token
    ) {
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $url = rtrim(config('app.frontend_url'), '/')

            . '/reset-password'

            . '?token=' . $this->token

            . '&email=' . urlencode($notifiable->email);

        return (new MailMessage)

            ->subject('Reset Your Fanget Password')

            ->greeting('Password Reset Request')

            ->line('We received a request to reset your password.')

            ->action(

                'Reset Password',

                $url

            )

            ->line('This link expires in 60 minutes.')

            ->line('If you did not request a password reset, simply ignore this email.')

            ->salutation('— Fanget Team');
    }
}

<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\URL;

class VerifyEmailNotification extends VerifyEmail
{
    /**
     * Build the verification URL.
     */
    protected function verificationUrl($notifiable)
    {
        return URL::temporarySignedRoute(

            'verification.verify',

            now()->addMinutes(60),

            [

                'id' => $notifiable->getKey(),

                'hash' => sha1(
                    $notifiable->getEmailForVerification()
                ),

            ]

        );
    }

    /**
     * Build the email.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)

            ->subject('Verify Your Fanget Account')

            ->greeting('Welcome to Fanget 👋')

            ->line('Thank you for registering.')

            ->line('Please verify your email address to activate your account.')

            ->action(

                'Verify Email',

                $this->verificationUrl($notifiable)

            )

            ->line('This verification link expires in 60 minutes.')

            ->salutation('— Fanget Team');
    }
}

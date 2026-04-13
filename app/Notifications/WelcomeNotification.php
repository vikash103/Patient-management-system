<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeNotification extends Notification
{
    use Queueable;

    public function __construct()
    {
        //
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
       return (new MailMessage)
    ->subject('Welcome to the Patient Management System')
    ->greeting('Hello ' . $notifiable->name . ',')
    ->line('We are pleased to welcome you to the Patient Management System.')
    ->line('Your account has been successfully created and is now ready to use.')
    ->line('With this platform, you can securely manage patient information, appointments, and medical records with ease.')
    ->action('Login to Your Account', url('/login'))
    ->line('If you did not create this account, please contact our support team immediately.')
    ->line('Thank you for being part of our system.')
    ->salutation('Best regards,')
    ->salutation('Patient Management System Team');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'User registered successfully'
        ];
    }
}
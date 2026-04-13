<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewUserNotification extends Notification
{
    use Queueable;

    protected $user;

    /**
     * Create a new notification instance.
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Delivery channels
     */
    public function via(object $notifiable): array
    {
        return ['database']; // bell notification ke liye
    }

    /**
     * Store data in database
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'New user registered: ' . $this->user->name,
            'user_id' => $this->user->id
        ];
    }
}
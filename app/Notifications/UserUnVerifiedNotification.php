<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserUnVerifiedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('We Are Sorry, You Are Not Verified by Our Admin!')
            ->line('Dear user, we regret to inform you that your account has not yet been verified by our administration team. This verification process is an essential step to ensure the integrity and security of our platform. Unfortunately, your account does not currently meet the criteria for verification. Please be patient while our team reviews your account details. Once your verification is complete, you will gain access to the full range of services and features our platform offers. We apologize for any inconvenience this may cause and thank you for your understanding as we work to enhance the quality and safety of our community')
            ->line('Kindly request account verification from our admin: bc200206394@vu.edu.pk. Thank you!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
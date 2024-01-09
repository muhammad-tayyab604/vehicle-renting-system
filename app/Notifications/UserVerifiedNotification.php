<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserVerifiedNotification extends Notification
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
            ->line('Your Account Has Been Verified Successfully')
            ->action('Login Now', url('/login'))
            ->line('We are thrilled to inform you that your account has successfully passed our verification process and has been officially verified. This means you now have full access to all the features and benefits of our platform. Your verified status demonstrates that you are a trusted member of our community, and it opens up a world of opportunities for you. You can now enjoy seamless access to all the resources, services, and privileges available to our valued members. We thank you for your patience and cooperation during the verification process and look forward to providing you with an exceptional experience on our platform. Welcome, and happy exploring!')
            ->line('Thank you for using our application!');
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
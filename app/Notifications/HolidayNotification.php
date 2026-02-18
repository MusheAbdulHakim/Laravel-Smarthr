<?php

namespace App\Notifications;

use App\Models\Holiday;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class HolidayNotification extends Notification implements ShouldQueue
{
    use Queueable, Dispatchable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Holiday $holiday)
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
            ->subject("Upcoming Holiday: {$this->holiday->name}")
            ->line("The holiday '{$this->holiday->name}' is starting on {$this->holiday->startDate?->format('M d, Y')}.")
            ->line($this->holiday->description)
            ->line('Plan your schedule accordingly!');
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

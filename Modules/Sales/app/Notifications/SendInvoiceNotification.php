<?php

namespace Modules\Sales\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Crypt;

class SendInvoiceNotification extends Notification
{
    use Dispatchable, Queueable;

    public $invoice;

    /**
     * Create a new notification instance.
     */
    public function __construct($invoice)
    {
        $this->invoice = $invoice;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable): MailMessage
    {
        $invoice = $this->invoice;

        return (new MailMessage)
            ->subject(__("You have a an invoice $invoice->inv_id"))
            ->line('You have a new invoice sent to you.')
            ->action('View Invoice', route('invoices.show', ['invoice' => Crypt::encrypt($invoice->id)]))
            ->line('Thank you for using our application!');
    }
}

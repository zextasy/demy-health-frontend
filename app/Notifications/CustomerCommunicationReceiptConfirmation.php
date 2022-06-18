<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class CustomerCommunicationReceiptConfirmation extends Notification
{
    use Queueable;


    private string $subject;
    private string $messageLine1;
    private string $messageLine2;

    /**
     * Create a new notification instance.
     * @return void
     */
    public function __construct(string $customerName)
    {
        $this->subject = 'Your message has been received';
        $this->messageLine1 = "Dear {$customerName}, your message has been received.";
        $this->messageLine2 = "We will get back to you shortly";
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject($this->subject)
            ->line($this->messageLine1)
            ->line($this->messageLine2)
            ->line('Thank you for Choosing DemyHealth!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}

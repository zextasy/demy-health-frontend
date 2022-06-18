<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class CustomerOrderNotification extends Notification
{
    use Queueable;

    private Order $order;
    private string $subject;
    private string $messageLine1;
    private string $messageLine2;
    private string $messageLine3;

    /**
     * Create a new notification instance.
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
        $this->subject = 'Your order has been received';
        $this->messageLine1 = "You have successfully placed order na order with us  on {$order->created_at}. ";
        $this->messageLine2 = "Your booking reference is {$order->reference}. Please keep this number safe. It will be used to retrieve your booking information";
        $this->messageLine3 = "Your summary is below";
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
            ->line($this->messageLine3)
            ->line('If you have registered on our site with this email, you can log in and view the details')
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

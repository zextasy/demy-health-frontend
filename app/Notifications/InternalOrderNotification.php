<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Filament\Notifications\Actions\Action;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Filament\Notifications\Notification as FilamentNotification;

class InternalOrderNotification extends Notification
{
    use Queueable;

    private Order $order;

    private string $message;

    private string $subject;

    public string $orderUrl;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
        $this->message = "An order was made by a customer, reference: {$order->reference} email: {$order->customer_email} on {$order->created_at->toDayDateTimeString()}";
        $this->subject = 'An order has been made';
        $this->orderUrl = $order->filament_url;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject($this->subject)
            ->line($this->message)
            ->action('View Order', $this->orderUrl)
            ->line('Please attend to this as soon as possible');
    }

    public function toDatabase($notifiable): array
    {
        return FilamentNotification::make()
            ->title($this->subject)
            ->body($this->message)
            ->actions([
                Action::make('View Order')
                    ->button()
                    ->url($this->orderUrl),
            ])
            ->getDatabaseMessage();
    }

    public function toArray($notifiable)
    {
        return [
            'title' => $this->subject,
            'message' => $this->message,
            'bookingUrl' => $this->orderUrl,
        ];
    }

}

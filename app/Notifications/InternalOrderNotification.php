<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Webbingbrasil\FilamentNotification\Actions\ButtonAction;
use Webbingbrasil\FilamentNotification\Notifications\NotificationLevel;

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
        return ['mail','database'];
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

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'level' => NotificationLevel::INFO,
            'title' => $this->subject,
            'message' => $this->message,
            'bookingUrl' => $this->orderUrl
        ];
    }

    static public function notificationFeedActions()
    {
        return [
            ButtonAction::make('viewOrder')
                ->label('View Order')
                ->action(function ($record) {
                    $record->markAsRead();
                    return redirect()->to($record->data['bookingUrl']);
                })
                ->outlined()
                ->color('blue'),
            ButtonAction::make('markRead')
                ->label('Mark as read')
                ->hidden(fn($record) => $record->read()) // Use $record to access/update notification, this is DatabaseNotification model
                ->action(function ($record, $livewire) {
                    $record->markAsRead();
                    $livewire->refresh(); // $livewire can be used to refresh ou reset notification feed
                })
                ->outlined()
                ->color('secondary'),
        ];
    }
}

<?php

namespace App\Notifications;

use App\Models\TestBooking;
use Illuminate\Bus\Queueable;
use Filament\Notifications\Actions\Action;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Filament\Notifications\Notification as FilamentNotification;

class InternalTestBookingNotification extends Notification
{
    use Queueable;

    private TestBooking $testBooking;

    private string $message;

    private string $subject;

    public string $bookingUrl;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(TestBooking $testBooking)
    {
        $this->testBooking = $testBooking;
        $testType = $testBooking->testType;
        $this->message = "{$testType->name} was booked by a customer, reference: {$testBooking->reference} email: {$testBooking->customer_email} on {$testBooking->created_at->toDayDateTimeString()}";
        $this->subject = 'A test has been booked';
        $this->bookingUrl = $testBooking->filament_url;
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
            ->action('View Booking', $this->bookingUrl)
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
            'title' => $this->subject,
            'message' => $this->message,
            'bookingUrl' => $this->bookingUrl,
        ];
    }

    public function toDatabase($notifiable): array
    {
        return FilamentNotification::make()
            ->title($this->subject)
            ->body($this->message)
            ->actions([
                Action::make('View Booking')
                    ->button()
                    ->url($this->bookingUrl),
            ])
            ->getDatabaseMessage();
    }
}

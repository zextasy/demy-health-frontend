<?php

namespace App\Notifications;

use App\Models\TestBooking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Webbingbrasil\FilamentNotification\Notifications\NotificationLevel;

class InternalTestBookingNotification extends Notification
{
    use Queueable;

    private TestBooking $testBooking;
    private string $message;
    private string $subject;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(TestBooking $testBooking)
    {
        $this->testBooking = $testBooking;
        $testType = $testBooking->testType;
        $this->message = "{$testType->description} was booked by a customer, email: {$testBooking->customer_email} on {$testBooking->created_at}";
        $this->subject = 'A test has been Booked';
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
//            ->action('View Booking', url($this->testBooking->filament_url))
            ->line('Thank you for using our application!');
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
            'message' => $this->message
        ];
    }
}

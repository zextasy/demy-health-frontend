<?php

namespace App\Notifications;

use App\Models\TestBooking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Enums\TestBooking\LocationTypeEnum;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CustomerTestBookingNotification extends Notification
{
    use Queueable;

    private TestBooking $testBooking;
    private string $subject;
    private string $messageLine1;
    private string $messageLine2;
    private string $messageLine3;
    private string $messageLine4;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(TestBooking $testBooking)
    {
        $this->testBooking = $testBooking;
        $testType = $testBooking->testType;
        $this->subject = 'Your test has been Booked';
        $this->messageLine1 = "You have successfully booked {$testType->description} on {$testBooking->created_at}. ";
        $this->messageLine2 = "Your booking is for {$testBooking->due_date} on {$testBooking->start_time}. ";
        $this->messageLine3 = match ($testBooking->location_type) {
            LocationTypeEnum::Home => 'Please be at your stated address',
            LocationTypeEnum::Center => 'Please be at the center',
            default => '',
        };
        $this->messageLine4 = $testType->should_call_in_for_details ? "Please call us for further details." : "Your results should be ready in {$testType->tat}.";
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
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
            ->line($this->messageLine1)
            ->line($this->messageLine2)
            ->line($this->messageLine3)
            ->line($this->messageLine4)
            ->line('Thank you for Choosing DemyHealth!');
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
            //
        ];
    }
}

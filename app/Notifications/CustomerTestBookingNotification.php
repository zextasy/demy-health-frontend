<?php

namespace App\Notifications;

use App\Models\TestBooking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Enums\TestBookings\LocationTypeEnum;
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
    private string $messageLine5;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(TestBooking $testBooking)
    {
        $this->testBooking = $testBooking;
        $testType = $testBooking->testType;
        $this->subject = 'Your test has been booked';
        $this->messageLine1 = "You have successfully booked {$testType->description} on {$testBooking->created_at->toDayDateTimeString()}. ";
        $this->messageLine2 = "Your booking reference is {$testBooking->reference}. Please keep this number safe. It will be used to retrieve your booking information";
        $this->messageLine3 = "Your booking is scheduled for {$testBooking->due_date->toDayDateTimeString()}";
        $this->messageLine4 = match ($testBooking->location_type) {
            LocationTypeEnum::HOME => "Please be at your stated address : {$testBooking->resolved_address_text}",
            LocationTypeEnum::CENTER => "Please be at the center : {$testBooking->resolved_address_text}",
            default => '',
        };
        $this->messageLine5 = $testType->should_call_in_for_details ? "Please call us for further details." : "Your results should be ready in {$testType->tat}.";
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
            ->line($this->messageLine5)
            ->line('If you have registered on our site with this email, you can log in and view the details.')
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

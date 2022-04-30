<?php

namespace App\Listeners;

use App\Events\TestBookedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\CustomerTestBookingNotification;

class SendCustomerTestBookingConfirmationListener implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  TestBookedEvent  $event
     * @return void
     */
    public function handle(TestBookedEvent $event)
    {
        Notification::route('mail', $event->testBooking->customer_email)
            ->notify(new CustomerTestBookingNotification($event->testBooking));
    }

    /**
     * Handle a job failure.
     *
     * @param TestBookedEvent $event
     * @param  \Throwable  $exception
     * @return void
     */
    public function failed(TestBookedEvent $event, $exception)
    {
        //
    }
}

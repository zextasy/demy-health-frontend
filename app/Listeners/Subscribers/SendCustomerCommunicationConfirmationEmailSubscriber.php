<?php

namespace App\Listeners\Subscribers;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\CustomerCommunicationReceiptConfirmation;

class SendCustomerCommunicationConfirmationEmailSubscriber implements ShouldQueue
{
    use InteractsWithQueue;

    const SEND_EMAIL_FUNCTION = 'App\Listeners\Subscribers\SendCustomerCommunicationConfirmationEmailSubscriber@sendCustomerCommunicationConfirmationEmail';

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
     * @param  object  $event
     * @return void
     */
    public function sendCustomerCommunicationConfirmationEmail($event)
    {
        Notification::route('mail', $event->customerEmail)
            ->notify(new CustomerCommunicationReceiptConfirmation($event->customerName));
    }

    public function subscribe($events)
    {
        $events->listen(
            'App\Events\ContactUsFormSubmittedEvent',
            self::SEND_EMAIL_FUNCTION
        );

        $events->listen(
            'App\Events\GetAQuoteFormSubmittedEvent',
            self::SEND_EMAIL_FUNCTION
        );

        $events->listen(
            'App\Events\GetInTouchFormSubmittedEvent',
            self::SEND_EMAIL_FUNCTION
        );
    }
}

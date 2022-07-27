<?php

namespace App\Listeners\Subscribers;

use App\Notifications\CustomerCommunicationReceiptConfirmation;
use App\Notifications\CustomerOrderNotification;
use App\Notifications\CustomerTestBookingNotification;
use App\Notifications\CustomerTestResultNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendCustomerCommunicationSubscriber implements ShouldQueue
{
    use InteractsWithQueue;

    const SEND_ENQUIRY_EMAIL_CONFIRMATION_FUNCTION = 'App\Listeners\Subscribers\SendCustomerCommunicationSubscriber@sendCustomerCommunicationConfirmationEmail';

    const SEND_TEST_BOOKING_EMAIL_CONFIRMATION_FUNCTION = 'App\Listeners\Subscribers\SendCustomerCommunicationSubscriber@sendCustomerTestBookingConfirmationEmail';

    const SEND_ORDER_EMAIL_CONFIRMATION_FUNCTION = 'App\Listeners\Subscribers\SendCustomerCommunicationSubscriber@sendCustomerOrderNotificationEmail';

    const SEND_TEST_RESULT_EMAIL_FUNCTION = 'App\Listeners\Subscribers\SendCustomerCommunicationSubscriber@sendCustomerTestResultNotificationEmail';

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
        Notification::route('mail', $event->customerEnquiry->customer_email)
            ->notify(new CustomerCommunicationReceiptConfirmation($event->customerEnquiry->customer_name));
    }

    public function sendCustomerTestBookingConfirmationEmail($event)
    {
        Notification::route('mail', $event->testBooking->customer_email)
            ->notify(new CustomerTestBookingNotification($event->testBooking));
    }

    public function sendCustomerOrderNotificationEmail($event)
    {
        Notification::route('mail', $event->order->customer_email)
            ->notify(new CustomerOrderNotification($event->order));
    }

    public function sendCustomerTestResultNotificationEmail($event)
    {
        Notification::route('mail', $event->testResult->customer_email)
            ->notify(new CustomerTestResultNotification($event->testResult));
    }

    public function subscribe($events)
    {
        $events->listen('App\Events\ContactUsFormSubmittedEvent', self::SEND_ENQUIRY_EMAIL_CONFIRMATION_FUNCTION);

        $events->listen('App\Events\GetAQuoteFormSubmittedEvent', self::SEND_ENQUIRY_EMAIL_CONFIRMATION_FUNCTION);

        $events->listen('App\Events\GetInTouchFormSubmittedEvent', self::SEND_ENQUIRY_EMAIL_CONFIRMATION_FUNCTION);

        $events->listen('App\Events\TestBookedEvent', self::SEND_TEST_BOOKING_EMAIL_CONFIRMATION_FUNCTION);

        $events->listen('App\Events\CartCheckedOutEvent', self::SEND_ORDER_EMAIL_CONFIRMATION_FUNCTION);

        $events->listen('App\Events\NewTestResultAddedEvent', self::SEND_TEST_RESULT_EMAIL_FUNCTION);
    }
}

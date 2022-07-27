<?php

namespace App\Listeners\Subscribers;

use App\Models\User;
use App\Notifications\InternalCustomerEnquiryNotification;
use App\Notifications\InternalOrderNotification;
use App\Notifications\InternalTestBookingNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendAdminFrontendNotificationSubscriber implements ShouldQueue
{
    use InteractsWithQueue;

    const SEND_ENQUIRY_EMAIL_FUNCTION = 'App\Listeners\Subscribers\SendAdminFrontendNotificationSubscriber@sendNotificationForContactEnquiry';

    const SEND_TEST_BOOKING_EMAIL_FUNCTION = 'App\Listeners\Subscribers\SendAdminFrontendNotificationSubscriber@sendNotificationForTestBooking';

    const SEND_ORDER_EMAIL_FUNCTION = 'App\Listeners\Subscribers\SendAdminFrontendNotificationSubscriber@sendCustomerOrderNotificationEmail';

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function sendNotificationForContactEnquiry($event)
    {
        $usersToNotify = User::query()->permission('process test booking')->get();
        Notification::send($usersToNotify, new InternalCustomerEnquiryNotification($event->customerEnquiry));
    }

    public function sendNotificationForTestBooking($event)
    {
        $usersToNotify = User::query()->permission('process test booking')->get();
        Notification::send($usersToNotify, new InternalTestBookingNotification($event->testBooking));
    }

    public function sendCustomerOrderNotificationEmail($event)
    {
        $usersToNotify = User::query()->permission('process test booking')->get();
        Notification::send($usersToNotify, new InternalOrderNotification($event->order));
    }

    public function subscribe($events)
    {
        $events->listen(
            'App\Events\ContactUsFormSubmittedEvent',
            self::SEND_ENQUIRY_EMAIL_FUNCTION
        );

        $events->listen(
            'App\Events\GetAQuoteFormSubmittedEvent',
            self::SEND_ENQUIRY_EMAIL_FUNCTION
        );

        $events->listen(
            'App\Events\GetInTouchFormSubmittedEvent',
            self::SEND_ENQUIRY_EMAIL_FUNCTION
        );

        $events->listen(
            'App\Events\TestBookedEvent',
            self::SEND_TEST_BOOKING_EMAIL_FUNCTION
        );

        $events->listen(
            'App\Events\OrderCreatedEvent',
            self::SEND_ORDER_EMAIL_FUNCTION
        );
    }
}

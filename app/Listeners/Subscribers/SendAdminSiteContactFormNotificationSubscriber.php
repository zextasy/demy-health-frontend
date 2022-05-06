<?php

namespace App\Listeners\Subscribers;

use App\Models\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\InternalCustomerEnquiryNotification;

class SendAdminSiteContactFormNotificationSubscriber implements ShouldQueue
{
    use InteractsWithQueue;

    const SEND_EMAIL_FUNCTION = 'App\Listeners\Subscribers\SendAdminSiteContactFormNotificationSubscriber@sendNotificationForContactEnquiry';

    /**
     * Create the event listener.
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

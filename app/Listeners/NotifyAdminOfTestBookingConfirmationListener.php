<?php

namespace App\Listeners;

use App\Models\User;
use App\Events\TestBookedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\InternalTestBookingNotification;

class NotifyAdminOfTestBookingConfirmationListener implements ShouldQueue
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
        $usersToNotify = User::query()->permission('process test booking')->get();
        Notification::send($usersToNotify, new InternalTestBookingNotification($event->testBooking));
    }
}

<?php

namespace App\Listeners\Communication;

use Illuminate\Notifications\Events\NotificationSent;
use App\Notifications\CommunicationNotification;

class SuccessfulCommunicationListener
{
    public function handle(NotificationSent $event)
    {
        if ($event->notification instanceof CommunicationNotification) {
            $event->notification->communication->logSendSuccess($event->channel);
        }
    }
}

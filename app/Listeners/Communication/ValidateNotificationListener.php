<?php

namespace App\Listeners\Communication;

use Illuminate\Notifications\Events\NotificationSending;

class ValidateNotificationListener
{
    public function handle(NotificationSending $event)
    {
        if (!method_exists($event->notifiable, 'hasValidRoute')) { // if we are sending an anonymous notification, we assume that a route exists
            return true;
        }

        return $event->notifiable->hasValidRoute($event->channel);
    }
}

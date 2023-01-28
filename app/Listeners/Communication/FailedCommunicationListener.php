<?php

namespace App\Listeners\Communication;

use App\Notifications\CommunicationNotification;
use function config;
use Exception;
use Illuminate\Notifications\Events\NotificationFailed;
use function now;

class FailedCommunicationListener
{
    /**
     * @throws Exception
     */
    public function handle(NotificationFailed $event)
    {
        if ($event->notification instanceof CommunicationNotification) {
            $communication = $event->notification->communication;

            $communication->logSendFailure($event->channel);

            if ($communication->sendingHasNotPermanentlyFailed($event->channel)) {
                // Trying to send failed notification. The channels to retry is handled
                // in the "via" function of the notification class.
                $event->notifiable->notify(
                    (new CommunicationNotification($communication, $communication->customer))
                        ->delay(now()->addSeconds(config('settings.communication.retry.delay')))
                );
            }
        }
    }
}

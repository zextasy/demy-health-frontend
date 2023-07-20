<?php

namespace App\Listeners\Communication;

use App\Jobs\DispatchCommunicationJob;
use App\Events\CommunicationCreatedEvent;

class DispatchCreatedCommunicationListener
{
    public function handle(CommunicationCreatedEvent $event)
    {
        DispatchCommunicationJob::dispatch($event->communication->communicable, $event->communication);
    }
}

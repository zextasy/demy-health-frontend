<?php

namespace App\Listeners;

use App\Events\TestBookedEvent;
use App\Events\CartCheckedOutEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class GenerateOrderNotificationListener implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function handle(CartCheckedOutEvent $event)
    {
        //TODO notify user
    }

    /**
     * Handle a job failure.
     *
     * @param TestBookedEvent $event
     * @param \Throwable $exception
     *
     * @return void
     */
    public function failed(CartCheckedOutEvent $event, $exception)
    {
        //
    }
}

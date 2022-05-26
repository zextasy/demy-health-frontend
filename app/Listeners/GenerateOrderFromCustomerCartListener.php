<?php

namespace App\Listeners;

use App\Events\TestBookedEvent;
use App\EventsCartCheckedOutEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class GenerateOrderFromCustomerCartListener implements ShouldQueue
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
        //TODO generate order
    }

    /**
     * Handle a job failure.
     *
     * @param TestBookedEvent $event
     * @param \Throwable $exception
     *
     * @return void
     */
    public function failed(TestBookedEvent $event, $exception)
    {
        //
    }
}

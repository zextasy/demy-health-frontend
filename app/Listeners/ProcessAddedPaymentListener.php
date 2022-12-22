<?php

namespace App\Listeners;

use App\Events\PaymentAddedEvent;
use App\Actions\Payments\ProcessPaymentAction;

class ProcessAddedPaymentListener
{
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
    public function handle(PaymentAddedEvent $event)
    {
        (new ProcessPaymentAction())->run($event->payment);
    }
}

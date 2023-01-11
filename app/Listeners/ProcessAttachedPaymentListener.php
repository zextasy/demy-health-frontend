<?php

namespace App\Listeners;

use App\Events\PaymentAttachedToPayableEvent;
use App\Actions\Payments\ProcessPaymentAction;

class ProcessAttachedPaymentListener
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
    public function handle(PaymentAttachedToPayableEvent $event)
    {
        (new ProcessPaymentAction())->run($event->payment);
    }
}

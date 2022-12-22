<?php

namespace App\Actions\Payments;

use App\Models\Finance\Payment;
use App\Events\PaymentAddedEvent;
use App\Enums\Finance\Payments\PaymentMethodEnum;

class CreatePaymentAction
{

    private ?array $internalReferences = null;
    private ?string $externalReference = null;
    private ?array $metadata = null;
    private bool $shouldRaiseEvents = true;

    public function run(int $amount, int|PaymentMethodEnum $method) : Payment
    {
        $payment =  new Payment();
        $payment->amount = $amount;
        $payment->payment_method = $method;
        $payment->internal_references = $this->internalReferences;
        $payment->external_reference = $this->externalReference;
        $payment->metadata = $this->metadata;
        $payment->save();

        $this->raiseEvents($this->shouldRaiseEvents, $payment);
        return $payment;
    }

    public function withInternalReferences(array|string $internalReferences) : self
    {
        $this->internalReferences = is_array($internalReferences) ?
            $internalReferences
            : explode(', ', $internalReferences);

        return  $this;
    }

    public function withExternalReference(string $externalReference) : self
    {
        $this->externalReference = $externalReference;

        return  $this;
    }

    public function withMetadata(array $metadata) : self
    {
        $this->metadata = $metadata;

        return  $this;
    }

    public function withEvents(bool $shouldRaiseEvents = true) : self
    {
        $this->shouldRaiseEvents = $shouldRaiseEvents;

        return  $this;
    }

    private function raiseEvents(bool $shouldRaiseEvents, Payment $payment): void
    {
        PaymentAddedEvent::dispatchIf($shouldRaiseEvents, $payment);
    }
}

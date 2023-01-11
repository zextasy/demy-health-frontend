<?php

namespace App\Actions\Payments;

use App\Models\Finance\Payment;
use App\Contracts\PayerContract;
use App\Events\PaymentAddedEvent;
use App\Enums\Finance\Payments\PaymentMethodEnum;

class CreatePaymentAction
{

    private ?array $internalReferences = null;
    private ?string $externalReference = null;
    private ?array $metadata = null;
    private bool $shouldRaiseEvents = true;
    private ?PayerContract $payer = null;
    private ?string $customerEmail = null;

    public function run(int $amount, int|PaymentMethodEnum $method) : ?Payment
    {
        $payment =  new Payment();
        $payment->amount = $amount;
        $payment->payment_method = $method;
        $payment->internal_references = $this->internalReferences;
        $payment->external_reference = $this->externalReference;
        $payment->customer_email = $this->customerEmail;
        $payment->payer_id = $this->payer?->getLaravelMorphModelId();
        $payment->payer_type = $this->payer?->getLaravelMorphModelType();
        $payment->metadata = $this->metadata;
        $payment->save();

        $this->raiseEvents($payment);
        return $payment;
    }

    public function paidBy(?PayerContract $payer): self
    {
        if (isset($payer)) {
            $this->payer = $payer;
            $this->customerEmail = $payer->getEmailForPayment();
        }

        return $this;
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

    public function withCustomerEmail(?string $customerEmail) : self
    {
        $this->customerEmail = $customerEmail;

        return  $this;
    }

    public function withEvents(bool $shouldRaiseEvents = true) : self
    {
        $this->shouldRaiseEvents = $shouldRaiseEvents;

        return  $this;
    }

    private function raiseEvents(Payment $payment): void
    {
        PaymentAddedEvent::dispatchIf($this->shouldRaiseEvents, $payment);
    }
}

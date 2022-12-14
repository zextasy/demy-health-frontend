<?php

namespace App\Actions\Payments;

use App\Models\Finance\Payment;
use App\Enums\Finance\Payments\PaymentMethodEnum;

class CreatePaymentAction
{

    private ?array $internalReferences = null;
    private ?string $externalReference = null;
    private ?array $metadata = null;

    public function run(int $amount, int|PaymentMethodEnum $method) : Payment
    {
        $payment =  new Payment();
        $payment->amount = $amount;
        $payment->payment_method = $method;
        $payment->internal_references = $this->internalReferences;
        $payment->external_reference = $this->externalReference;
        $payment->metadata = $this->metadata;
        $payment->save();

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
}

<?php

namespace App\Actions;

use App\Models\Finance\Payment;
use App\Enums\Finance\Payments\PaymentMethodEnum;

class CreatePaymentAction
{

    private ?array $internalReferences = null;
    private ?string $externalReference = null;

    public function execute(int $amount, int|PaymentMethodEnum $method) : Payment
    {
        $payment =  new Payment();
        $payment->amount = $amount;
        $payment->payment_method = $method;
        $payment->internal_references = $this->internalReferences;
        $payment->external_reference = $this->externalReference;
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
}

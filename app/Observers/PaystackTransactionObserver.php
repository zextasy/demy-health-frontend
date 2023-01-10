<?php

namespace App\Observers;



use App\Models\Finance\PaystackTransaction;
use App\Actions\Payments\CreatePaymentAction;
use App\Enums\Finance\Payments\PaymentMethodEnum;

class PaystackTransactionObserver
{
    public function saved(PaystackTransaction $model)
    {
        if ($model->success && $model->doesntHavePayment()) {
            (new CreatePaymentAction)
                ->withExternalReference($model->reference)
                ->withInternalReferences($model->invoice_reference)
                ->withCustomerEmail($model->customer_email)
                ->withMetadata($model->metadata)
                ->run($model->amount/100, PaymentMethodEnum::PAYSTACK);
        }
    }

}

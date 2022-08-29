<?php

namespace App\Actions;

use App\Models\Finance\Payment;
use App\Contracts\PayableContract;
use App\Enums\Finance\Payments\PaymentMethodEnum;

class CreatePaymentAction
{

    public function execute(PayableContract $payableContract, int $amount, int|PaymentMethodEnum $method) : Payment
    {
        $payment =  new Payment();
        $payment->amount = $amount;
        $payment->type = $method;
        $payment->payable_id = $payableContract->id;
        $payment->payable_type = get_class($payableContract);
        $payment->save();

        return $payment;
    }
}

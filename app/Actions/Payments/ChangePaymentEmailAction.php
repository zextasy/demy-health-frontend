<?php

namespace App\Actions\Payments;

use App\Models\Finance\Payment;

class ChangePaymentEmailAction
{

    public function run(Payment|int $payment, string $email): Payment
    {
        $payment = $payment instanceof Payment ? $payment : Payment::findOrFail($payment);
        $payment->update(['customer_email' => $email]);
        return $payment;
    }
}

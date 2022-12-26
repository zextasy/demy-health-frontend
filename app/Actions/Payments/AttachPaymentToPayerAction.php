<?php

namespace App\Actions\Payments;

use Exception;
use App\Models\Finance\Payment;
use App\Contracts\PayerContract;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AttachPaymentToPayerAction
{

    public function run(Payment|int $payment, PayerContract $customer): bool
    {
        $payment = $payment instanceof Payment ? $payment : Payment::findOrFail($payment);
        try {
            DB::transaction(function () use ($customer, $payment) {
                $payment->payer_id = $customer->getLaravelMorphModelId();
                $payment->payer_type = $customer->getLaravelMorphModelType();
                $payment->save();
            });

            return true;
        } catch (Exception $e) {
            Log::error($e);

            return false;
        }
    }
}

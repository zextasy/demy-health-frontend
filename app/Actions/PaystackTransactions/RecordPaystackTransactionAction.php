<?php

namespace App\Actions\PaystackTransactions;

use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Carbon;
use App\Contracts\AssignableContract;
use App\Models\Finance\PaystackTransaction;

class RecordPaystackTransactionAction
{

    public function run(bool $success, array $paymentDataArray) : PaystackTransaction
    {
        $reference = $paymentDataArray['reference'];
        $paystackTransaction = PaystackTransaction::firstOrNew(['reference' =>  $reference]);

        $paystackTransaction->fill($paymentDataArray);

        $paystackTransaction->success = $success;
        $paystackTransaction->invoice_reference = $paymentDataArray['metadata']['invoice_reference'] ?? null;
        $paystackTransaction->customer_email = $paymentDataArray['customer']['email'] ?? null;

        $paystackTransaction->save();

        return $paystackTransaction;
    }

}

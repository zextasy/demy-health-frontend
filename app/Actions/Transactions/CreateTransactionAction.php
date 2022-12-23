<?php

namespace App\Actions\Transactions;

use Illuminate\Support\Facades\DB;
use App\Models\Finance\Transaction;
use App\Contracts\TransactionDebitableContract;
use App\Contracts\TransactionCreditableContract;


class CreateTransactionAction
{


    public function run(
        TransactionCreditableContract $creditable,
        TransactionDebitableContract $debitable
    ): ?Transaction
    {
        $amount = min($creditable->getMaximumCreditableAmount(), $debitable->getMaximumDebitableAmount());

        if ($amount < 1) {
            $creditable->updatePaymentStatus();
            $debitable->updatePaymentStatus();
            return null;
        }

        $transaction = new Transaction;
        $transaction->amount = $amount;
        $transaction->creditable_id = $creditable->getLaravelMorphModelId();
        $transaction->creditable_type = $creditable->getLaravelMorphModelType();
        $transaction->debitable_id = $debitable->getLaravelMorphModelId();
        $transaction->debitable_type = $debitable->getLaravelMorphModelType();
        DB::transaction(function () use ($debitable, $creditable, $transaction) {
            $transaction->save();
            $creditable->updatePaymentStatus();
            $debitable->updatePaymentStatus();
        });

        return $transaction;
    }
}

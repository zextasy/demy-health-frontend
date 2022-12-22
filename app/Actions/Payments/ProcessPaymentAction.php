<?php

namespace App\Actions\Payments;

use App\Models\Finance\Payment;
use App\Models\Finance\Invoice;
use Illuminate\Support\Collection;
use App\Actions\Transactions\CreateTransactionAction;


class ProcessPaymentAction
{

    private Collection $payables;

    public function __construct()
    {
        $this->payables = new Collection();
    }

    public function run(int|Payment $payment): int
    {
        $count = 0;
        $payment = $payment instanceof Payment ? $payment : Payment::findOrFail($payment);
        $this->payables = $this->resolveOutstandingPayables($payment->internal_references);
        $action = new CreateTransactionAction;
        foreach ($this->payables as $payable) {
            if ($action->run($payable, $payment)) {
                $count++;
            }
        }

        return $count;
    }

    private function resolveOutstandingPayables(array $references): Collection
    {
        return Invoice::whereIn('reference', $references)->get();
    }
}

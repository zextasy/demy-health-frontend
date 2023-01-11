<?php

namespace App\Actions\Payments;

use Exception;
use App\Models\Finance\Payment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use App\Events\PaymentAttachedToPayableEvent;
use App\Contracts\TransactionCreditableContract;

class AttachPaymentToPayablesAction
{

    private bool $shouldRaiseEvents = true;

    public function run(Payment|int $payment, TransactionCreditableContract|Collection $payables): bool
    {
        $payment = $payment instanceof Payment ? $payment : Payment::findOrFail($payment);
        $payables = $payables instanceof Collection ? $payables : collect([$payables]);
        try {
            DB::transaction(function () use ($payables, $payment) {
                $references = $payment->internal_references ?? [];
                foreach ($payables as $payable) {
                    $payableReference = $payable->getPayableReference();
                    if (!in_array($payableReference, $references)) {
                        $references[] = $payableReference;
                    }
                }
                $payment->internal_references = $references;
                ray($payment->internal_references);
                $payment->save();
            });
            $this->raiseEvents($payment);
            return true;
        } catch (Exception $e) {
            Log::error($e);

            return false;
        }
    }

    public function withEvents(bool $shouldRaiseEvents = true) : self
    {
        $this->shouldRaiseEvents = $shouldRaiseEvents;

        return  $this;
    }

    private function raiseEvents(Payment $payment): void
    {
        PaymentAttachedToPayableEvent::dispatchIf($this->shouldRaiseEvents, $payment);
    }
}

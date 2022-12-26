<?php

namespace App\Actions\Invoices;

use Exception;
use App\Models\Finance\Invoice;
use App\Models\Finance\Payment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Contracts\InvoiceableCustomerContract;
use App\Actions\Payments\AttachPaymentToPayerAction;

class AttachInvoiceToCustomerAction
{

    public function run(Invoice|int $invoice, InvoiceableCustomerContract $customer): bool
    {
        $invoice = $invoice instanceof Invoice ? $invoice : Invoice::findOrFail($invoice);
        $invoice->loadMissing(['transactions']);
        try {
            DB::transaction(function () use ($customer, $invoice) {
                $invoice->customer_id = $customer->getLaravelMorphModelId();
                $invoice->customer_type = $customer->getLaravelMorphModelType();
                $invoice->save();
                if ($invoice->transactions()->count() > 0) {
                    foreach ($invoice->transactions as $transaction) {
                        if ($transaction->debitable instanceof Payment) {
                            (new AttachPaymentToPayerAction())->run($transaction->debitable, $customer);
                        }
                    }


                }
            });

            return true;
        } catch (Exception $e) {
            Log::error($e);

            return false;
        }
    }
}

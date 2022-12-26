<?php

namespace App\Actions\Invoices;

use App\Models\Finance\Invoice;
use App\Models\Finance\Payment;
use Illuminate\Support\Facades\DB;
use App\Actions\Payments\ChangePaymentEmailAction;

class ChangeInvoiceEmailAction
{

    public function run(Invoice|int $invoice, string $email): Invoice
    {
        $invoice = $invoice instanceof Invoice ? $invoice : Invoice::findOrFail($invoice);
        DB::transaction(function () use ($email, $invoice) {
            $invoice->update(['customer_email' => $email]);
            if ($invoice->transactions()->count() > 0) {
                foreach ($invoice->transactions as $transaction) {
                    if ($transaction->debitable instanceof Payment) {
                        (new ChangePaymentEmailAction())->run($transaction->debitable, $email);
                    }
                }
            }
        });

        return $invoice;
    }
}

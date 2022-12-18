<?php

namespace App\Actions\Invoices;

use App\Models\Finance\Invoice;

class ChangeInvoiceEmailAction
{

    public function run(Invoice|int $invoice, string $email): Invoice
    {
        $invoice = $invoice instanceof Invoice ? $invoice : Invoice::findOrFail($invoice);
        $invoice->update(['customer_email' => $email]);
        return $invoice;
    }
}

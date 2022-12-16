<?php

namespace App\Actions\Invoices;

use Exception;
use App\Models\Order;
use App\Models\Finance\Invoice;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DeleteInvoiceAction
{

    public function run(Invoice|int|null $invoice): bool
    {
        if (empty($invoice)) {
            return true;
        }
        $invoice = $invoice instanceof Invoice ? $invoice : Invoice::findOrFail($invoice);
        $invoice->loadMissing(['items']);
        try {
            DB::transaction(function () use ($invoice) {
                $invoice->items()->delete();
                $invoice->delete();
            });

            return true;
        }
        catch (Exception $e) {
            Log::error($e);

            return false;
        }
    }
}

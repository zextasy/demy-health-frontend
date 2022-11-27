<?php

namespace App\Actions\InvoiceItems;

use App\Models\Finance\Invoice;
use App\Models\Finance\InvoiceItem;
use App\Contracts\InvoiceableItemContract;
use Illuminate\Support\Facades\DB;

class CreateInvoiceItemAction
{
    public function run(Invoice|int $invoice, InvoiceableItemContract $invoiceableItem, float $quantity = 1, string $name = null, float $price = null): InvoiceItem
    {
        $invoiceId = $invoice instanceof Invoice ? $invoice->id : $invoice;
        $invoiceItem = new InvoiceItem;
        $invoiceItem->invoice_id = $invoiceId;
        $invoiceItem->name = $name ?? $invoiceableItem->getInvoiceableItemName();
        $invoiceItem->price = $price ?? $invoiceableItem->getInvoiceableItemPrice();
        $invoiceItem->quantity = $quantity;
        $invoiceItem->invoiceable_item_type = $invoiceableItem->getLaravelMorphModelType();
        $invoiceItem->invoiceable_item_id = $invoiceableItem->getLaravelMorphModelId();

        DB::transaction(function () use ($invoiceItem) {
            $invoiceItem->save();
        });

        return $invoiceItem;
    }
}

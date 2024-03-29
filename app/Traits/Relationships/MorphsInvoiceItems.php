<?php

namespace App\Traits\Relationships;

use App\Models\Finance\InvoiceItem;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait MorphsInvoiceItems
{
    public function invoiceItems(): MorphMany
    {
        return $this->MorphMany(InvoiceItem::class, 'invoiceable_item');
    }

    public function hasBeenInvoiced(): bool
    {
        return  $this->invoiceItems()->exists();
    }

    public function hasNotBeenInvoiced(): bool
    {
        return  !$this->hasBeenInvoiced();
    }
}

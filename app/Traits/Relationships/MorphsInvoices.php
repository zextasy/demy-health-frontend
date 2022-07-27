<?php

namespace App\Traits\Relationships;

use App\Models\Finance\Invoice;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait MorphsInvoices
{
    public function invoices(): MorphMany
    {
        return $this->MorphMany(Invoice::class, 'invoiceable');
    }
}

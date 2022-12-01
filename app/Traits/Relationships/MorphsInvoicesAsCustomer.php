<?php

namespace App\Traits\Relationships;

use App\Models\Finance\Invoice;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait MorphsInvoicesAsCustomer
{
    public function invoices(): MorphMany
    {
        return $this->MorphMany(Invoice::class, 'customer');
    }
}

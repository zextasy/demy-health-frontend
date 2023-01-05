<?php

namespace App\Traits\Relationships;

use App\Models\Finance\Invoice;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasInvoicesViaEmail
{
    public function invoices(): HasMany
    {
        return $this->HasMany(Invoice::class, 'customer_email', 'email');
    }
}

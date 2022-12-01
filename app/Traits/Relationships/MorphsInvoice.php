<?php

namespace App\Traits\Relationships;

use App\Models\Finance\Invoice;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait MorphsInvoice
{
    public function invoice(): MorphOne
    {
        return $this->MorphOne(Invoice::class, 'invoiceable');
    }
}

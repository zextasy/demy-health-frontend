<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphMany;

interface InvoiceableItemContract
{
    public function invoiceItems(): MorphMany;

    public function getInvoiceableItemName() : string;

    public function getInvoiceableItemPrice() : float;

    public function getLaravelMorphModelType(): string;

    public function getLaravelMorphModelId(): int;
}

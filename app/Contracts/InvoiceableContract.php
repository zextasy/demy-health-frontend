<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphMany;

interface InvoiceableContract
{
    public function invoices(): MorphMany;

    public function getLaravelMorphModelType(): string;

    public function getLaravelMorphModelId(): int;
}

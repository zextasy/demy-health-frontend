<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphOne;

interface InvoiceableContract
{
    public function invoice(): MorphOne;

    public function getLaravelMorphModelType(): string;

    public function getLaravelMorphModelId(): int;
}

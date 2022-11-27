<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphMany;

interface OrderableContract
{
    public function orders(): MorphMany;

    public function getLaravelMorphModelType(): string;

    public function getLaravelMorphModelId(): int;
}

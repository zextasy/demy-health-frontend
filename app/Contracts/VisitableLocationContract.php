<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphMany;

interface VisitableLocationContract
{
    public function getLaravelMorphModelType(): string;
    public function getLaravelMorphModelId(): int;
    public function getFilamentUrl(): string;
}

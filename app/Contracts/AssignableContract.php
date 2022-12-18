<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphMany;

interface AssignableContract
{
    public function tasks(): MorphMany;
    public function getLaravelMorphModelType(): string;
    public function getLaravelMorphModelId(): int;
    public function getFilamentUrl(): string;
    public function getAssignableName(): string;
}

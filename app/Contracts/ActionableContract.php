<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphMany;

interface ActionableContract
{
    public function actionableTasks(): MorphMany;
    public function getLaravelMorphModelType(): string;
    public function getLaravelMorphModelId(): int;
    public function getFilamentUrl(): string;
    public function getActionableName(): string;
}

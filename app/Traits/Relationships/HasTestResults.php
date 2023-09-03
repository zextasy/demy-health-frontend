<?php

namespace App\Traits\Relationships;

use App\Models\OrderItem;
use App\Models\TestResult;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasTestResults
{
    public function resultHasBeenGenerated(): bool
    {
        return $this->testResults()->exists();
    }

    public function resultHasNotBeenGenerated(): bool
    {
        return !$this->resultHasBeenGenerated();
    }

    public function testResultIsComplete():bool
    {
        //TODO : flesh out
        return false;
    }

    public function testResultIsNotComplete():bool
    {
        return !$this->testResultIsComplete();
    }

    public function testResults(): HasMany
    {
        return $this->hasMany(TestResult::class);
    }
}

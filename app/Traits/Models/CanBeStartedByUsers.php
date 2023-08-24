<?php

namespace App\Traits\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait CanBeStartedByUsers
{
    public function hasBeenStarted(): bool
    {
        return isset($this->started_at) && isset($this->started_by);
    }

    public function hasNotBeenStarted(): bool
    {
        return !$this->hasBeenStarted();
    }

    public function startedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'started_by');
    }
}

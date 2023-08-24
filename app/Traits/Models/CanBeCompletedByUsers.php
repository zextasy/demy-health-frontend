<?php

namespace App\Traits\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait CanBeCompletedByUsers
{
    public function hasBeenCompleted(): bool
    {
        return isset($this->completed_at) && isset($this->completed_by);
    }

    public function hasNotBeenCompleted(): bool
    {
        return !$this->hasBeenCompleted();
    }

    public function completedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'completed_by');
    }
}

<?php

namespace App\Traits\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait CanBeRejectedByUsers
{
    public function hasBeenRejected(): bool
    {
        return isset($this->rejected_at) && isset($this->rejected_by);
    }

    public function hasNotBeenRejected(): bool
    {
        return !$this->hasBeenRejected();
    }

    public function rejectedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'rejected_by');
    }
}

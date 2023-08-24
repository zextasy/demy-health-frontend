<?php

namespace App\Traits\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait CanBeApprovedByUsers
{
    public function hasBeenApproved(): bool
    {
        return isset($this->approved_at) && isset($this->approved_by);
    }

    public function hasNotBeenApproved(): bool
    {
        return !$this->hasBeenApproved();
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}

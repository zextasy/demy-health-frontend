<?php

namespace App\Traits\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait CanBeAssignedByUsers
{
    public function wasAssignedBy(int|User $user): bool
    {
        $userId = $user instanceof User ? $user->id : $user;
        return $this->assigned_by === $userId;
    }

    public function assignedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }
}

<?php

namespace App\Traits\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait CanBeAssignedToUsers
{
    public function wasAssignedTo(int|User $user): bool
    {
        $userId = $user instanceof User ? $user->id : $user;
        return $this->assigned_to === $userId;
    }

    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}

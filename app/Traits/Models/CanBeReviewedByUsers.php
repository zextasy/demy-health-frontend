<?php

namespace App\Traits\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait CanBeReviewedByUsers
{
    public function needsCompletionReview(): bool
    {
        return isset($this->completion_confirmation_requested_at) && isset($this->completion_confirmation_requested_by);
    }

    public function doesNotNeedCompletionReview(): bool
    {
        return !$this->needsCompletionReview();
    }

    public function completionApprovedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'completion_confirmation_approved_by');
    }

    public function completionRejectedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'completion_confirmation_rejected_by');
    }

    public function reviewedBy(): ?User
    {
        return $this->completionApprovedBy ?? $this->completionApprovedBy ?? null;
    }
}

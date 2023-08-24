<?php

namespace App\Traits\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait SamplesAreProcessedByUsers
{
    public function sampleCollectionHasBeenApproved(): bool
    {
        return $this->sample_collection_approved_at !== null;
    }

    public function sampleHasBeenReceived(): bool
    {
        return $this->sample_received_at !== null;
    }

    public function processingHasBeenInitiated(): bool
    {
        return $this->processing_initiated_at !== null;
    }

    public function processingIsComplete(): bool
    {
        return $this->processing_completed_at !== null;
    }

    public function resultHasBeenApproved(): bool
    {
        return $this->result_approved_at !== null;
    }

    public function sampleWasRejected(): bool
    {
        return $this->sample_rejected_at !== null;
    }

    public function sampleCollectionApprovedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sample_collection_approved_by');
    }

    public function sampleReceivedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sample_received_by');
    }

    public function resultApprovedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'result_approved_by');
    }

    public function sampleRejectedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sample_rejected_by');
    }
}

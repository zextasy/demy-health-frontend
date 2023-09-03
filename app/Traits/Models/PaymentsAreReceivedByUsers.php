<?php

namespace App\Traits\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait PaymentsAreReceivedByUsers
{
    public function paymentHasBeenReceived(): bool
    {
        return $this->payment_received_at !== null;
    }

    public function paymentRecordedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'payment_recorded_by');
    }
}

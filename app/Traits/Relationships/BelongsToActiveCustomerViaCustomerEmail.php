<?php

namespace App\Traits\Relationships;

use App\Models\User;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToActiveCustomerViaCustomerEmail
{
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class, 'customer_email', 'email');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_email', 'email');
    }

    public function activeCustomer(): BelongsTo
    {
        return $this->user()->exists() ? $this->user() : $this->patient();
    }
}

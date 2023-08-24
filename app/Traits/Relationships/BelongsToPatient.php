<?php

namespace App\Traits\Relationships;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToPatient
{
	public function patient(): BelongsTo
	{
		return $this->belongsTo(Patient::class);
	}
}

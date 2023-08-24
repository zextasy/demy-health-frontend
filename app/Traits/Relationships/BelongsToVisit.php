<?php

namespace App\Traits\Relationships;

use App\Models\Visit;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToVisit
{
	public function visit(): BelongsTo
	{
		return $this->belongsTo(Visit::class);
	}
}

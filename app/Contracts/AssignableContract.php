<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphMany;

interface AssignableContract
{
    public function tasks(): MorphMany;
    public function getFilamentUrlAttribute(): string;
    public function getAssignableNameAttribute(): string;
}

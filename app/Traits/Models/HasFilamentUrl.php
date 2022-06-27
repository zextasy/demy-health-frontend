<?php

namespace App\Traits\Models;

use App\Helpers\ModelHelper;
use Illuminate\Database\Eloquent\Model;
use App\Filament\Resources\TestTypeResource;

trait HasFilamentUrl
{
    public function getFilamentUrlAttribute(): string
    {
        $filamentResource = $this->getFilamentResourceClass();
        return $filamentResource::getUrl('view', ['record' => $this->id]);
    }

    abstract public function getFilamentResourceClass(): string;
}


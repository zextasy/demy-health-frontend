<?php

namespace App\Traits\Models;

trait HasFilamentUrl
{
    public function getFilamentUrlAttribute(): string
    {
        $filamentResource = $this->getFilamentResourceClass();

        return $filamentResource::getUrl('view', ['record' => $this->id]);
    }

    abstract public function getFilamentResourceClass(): string;
}

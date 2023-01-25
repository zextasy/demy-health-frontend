<?php

namespace App\Traits\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasFilamentUrl
{
    protected function filamentUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getFilamentUrl(),
        );
    }

    public function getFilamentUrl(): string
    {
        $filamentResource = $this->getFilamentResourceClass();

        return $filamentResource::getUrl('view', ['record' => $this->id]);
    }

    abstract public function getFilamentResourceClass(): string;
}

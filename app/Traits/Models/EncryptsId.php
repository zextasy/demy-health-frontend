<?php

namespace App\Traits\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait EncryptsId
{

    protected function encryptedId(): Attribute
    {
        return Attribute::make(
            get: fn () => encrypt($this->id),
        );
    }
}

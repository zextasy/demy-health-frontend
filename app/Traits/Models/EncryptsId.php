<?php

namespace App\Traits\Models;

trait EncryptsId
{
    public function getEncryptedIdAttribute(): string
    {
        return encrypt($this->id);
    }
}

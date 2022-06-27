<?php

namespace App\Traits\Models;

use App\Helpers\ModelHelper;
use Illuminate\Database\Eloquent\Model;

trait HasAmounts
{

    public function getformattedAmountAttribute()
    {
        return number_format($this->amount);
    }
}

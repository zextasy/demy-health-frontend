<?php

namespace App\Models\Pivots;

use Illuminate\Database\Eloquent\Relations\MorphPivot;

class Addressable extends  MorphPivot
{
    protected $table = 'addressables';
}

<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphToMany;

interface VirtualFieldableContract
{
    public function virtualFields(): morphToMany;
}

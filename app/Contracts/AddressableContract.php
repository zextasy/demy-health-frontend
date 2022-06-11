<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphToMany;

interface AddressableContract
{
    public function addresses(): MorphToMany;
}

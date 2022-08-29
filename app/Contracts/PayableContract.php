<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphMany;

interface PayableContract
{
    public function paymentsReceived(): MorphMany;
}

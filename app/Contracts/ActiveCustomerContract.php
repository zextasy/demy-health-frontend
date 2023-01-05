<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Relations\HasMany;

interface ActiveCustomerContract
{
    public function getFullName():string;

    public function orders(): HasMany;

    public function invoices(): HasMany;

    public function payments(): HasMany;
}

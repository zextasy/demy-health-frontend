<?php

namespace App\Traits\Resources;

use App\Settings\GeneralSettings;

trait DisplaysCurrencies
{
    protected static function getSystemDefaultCurrency(): string
    {
        return app(GeneralSettings::class)->default_currency;
    }
}

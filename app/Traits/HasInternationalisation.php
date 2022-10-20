<?php

namespace App\Traits\Resources;

use App\Settings\GeneralSettings;

trait HasInternationalisation
{

    public function getSystemDefaultCurrency(): string
    {
        return app(GeneralSettings::class)->default_currency;
    }
}

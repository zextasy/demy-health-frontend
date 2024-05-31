<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use App\Traits\Enums\HasSelectArrayOptions;
use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Names;
use ArchTech\Enums\Options;
use ArchTech\Enums\Values;
use App\Traits\Enums\HasDefaultFilamentLabels;

enum CurrencyEnum: string implements HasLabel
{
    //TODO use squire php package?
    use InvokableCases;
    use Names;
    use Values;
    use Options;
    use HasDefaultFilamentLabels;

    case US_DOLLAR = 'USD';

    case NIGERIAN_NAIRA = 'NGN';
}

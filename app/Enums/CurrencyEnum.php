<?php

namespace App\Enums;

use App\Traits\Enums\HasSelectArrayOptions;
use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Names;
use ArchTech\Enums\Options;
use ArchTech\Enums\Values;

enum CurrencyEnum: string
{
    use InvokableCases, Names, Values, Options, HasSelectArrayOptions;

    case US_DOLLAR = 'USD';

    case NIGERIAN_NAIRA = 'NGN';
}

<?php

namespace App\Enums;

use App\Traits\Enums\HasSelectArrayOptions;
use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Names;
use ArchTech\Enums\Options;
use ArchTech\Enums\Values;

enum LocaleEnum: string
{
    use InvokableCases, Names, Values, Options, HasSelectArrayOptions;

    case EN_US = 'en-US';
}

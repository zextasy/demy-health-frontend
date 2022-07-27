<?php

namespace App\Enums;

use App\Traits\Enums\HasSelectArrayOptions;
use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Names;
use ArchTech\Enums\Options;
use ArchTech\Enums\Values;

enum GenderEnum: int
{
    use InvokableCases, Names, Values, Options, HasSelectArrayOptions;

    case MALE = 1;
    case FEMALE = 2;

    case OTHER = 200;
}

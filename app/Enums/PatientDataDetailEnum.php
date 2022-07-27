<?php

namespace App\Enums;

use App\Traits\Enums\HasSelectArrayOptions;
use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Names;
use ArchTech\Enums\Options;
use ArchTech\Enums\Values;

enum PatientDataDetailEnum: int
{
    use InvokableCases, Names, Values, Options, HasSelectArrayOptions;

    case REGULAR = 1;
    case DETAILED = 2;

    case NONE = 200;
}

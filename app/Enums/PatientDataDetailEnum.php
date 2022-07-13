<?php

namespace App\Enums;

use ArchTech\Enums\Names;
use ArchTech\Enums\Values;
use ArchTech\Enums\Options;
use ArchTech\Enums\InvokableCases;
use App\Traits\Enums\HasSelectArrayOptions;

enum PatientDataDetailEnum: int
{
    use InvokableCases, Names, Values, Options, HasSelectArrayOptions;


    case REGULAR = 1;
    case DETAILED = 2;

    case NONE = 200;
}

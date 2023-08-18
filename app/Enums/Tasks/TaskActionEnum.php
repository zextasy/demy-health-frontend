<?php

namespace App\Enums\Tasks;

use App\Traits\Enums\HasSelectArrayOptions;
use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Names;
use ArchTech\Enums\Options;
use ArchTech\Enums\Values;

enum TaskActionEnum: int
{
    use InvokableCases, Names, Values, Options, HasSelectArrayOptions;

    case UNKNOWN = 1;
    case START = 10;

    case COMPLETE = 500;
}

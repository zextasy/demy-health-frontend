<?php

namespace App\Enums\Tasks;

use App\Traits\Enums\HasSelectArrayOptions;
use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Names;
use ArchTech\Enums\Options;
use ArchTech\Enums\Values;

enum TaskTypeEnum: int
{
    use InvokableCases, Names, Values, Options, HasSelectArrayOptions;

    case GENERIC = 1;
    case CONSULTATION = 10;

    case OTHER = 200;
}

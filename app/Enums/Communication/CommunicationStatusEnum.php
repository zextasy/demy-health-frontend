<?php

namespace App\Enums\Communication;

use App\Traits\Enums\HasSelectArrayOptions;
use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Names;
use ArchTech\Enums\Options;
use ArchTech\Enums\Values;

enum CommunicationStatusEnum: int
{
    use InvokableCases, Names, Values, Options, HasSelectArrayOptions;

    case PENDING = 1;

    case SUCCESSFUL = 10;

    case CANCELLED = 20;

    case FAILED = 30;

    case PERMANENT_FAILURE = 39;
}

<?php

namespace App\Enums;

use App\Traits\Enums\HasSelectArrayOptions;
use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Names;
use ArchTech\Enums\Options;
use ArchTech\Enums\Values;

enum PatientAcquisitionTypeEnum: int
{
    use InvokableCases, Names, Values, Options, HasSelectArrayOptions;

    case WALK_IN = 1;
    case TEST_BOOKING = 2;

    case OTHER = 200;
}

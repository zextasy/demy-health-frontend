<?php

namespace App\Enums;

use ArchTech\Enums\Names;
use ArchTech\Enums\Values;
use ArchTech\Enums\Options;
use ArchTech\Enums\InvokableCases;
use App\Traits\Enums\HasSelectArrayOptions;

enum PatientAcquisitionTypeEnum: int
{
    use InvokableCases, Names, Values, Options, HasSelectArrayOptions;


    case WALK_IN = 1;
    case TEST_BOOKING = 2;

    case OTHER = 200;
}

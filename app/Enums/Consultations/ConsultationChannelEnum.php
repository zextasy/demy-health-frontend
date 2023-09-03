<?php

namespace App\Enums\Consultations;

use ArchTech\Enums\Names;
use ArchTech\Enums\Values;
use ArchTech\Enums\Options;
use ArchTech\Enums\InvokableCases;
use App\Traits\Enums\HasSelectArrayOptions;

enum ConsultationChannelEnum: int
{
    use InvokableCases, Names, Values, Options, HasSelectArrayOptions;

    case NONE = 1;

    case ZOOM = 10;
}

<?php

namespace App\Enums\TestBookings;

use App\Traits\Enums\HasSelectArrayOptions;
use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Names;
use ArchTech\Enums\Options;
use ArchTech\Enums\Values;

enum LocationTypeEnum: int
{
    use InvokableCases, Names, Values, Options, HasSelectArrayOptions;

    case CENTER = 1;
    case HOME = 2;
}

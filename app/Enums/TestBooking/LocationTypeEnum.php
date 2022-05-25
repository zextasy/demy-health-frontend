<?php

namespace App\Enums\TestBooking;

use ArchTech\Enums\Names;
use ArchTech\Enums\Values;
use ArchTech\Enums\Options;
use ArchTech\Enums\InvokableCases;
use App\Traits\Enums\HasSelectArrayOptions;

enum LocationTypeEnum: int
{
    use InvokableCases, Names, Values, Options, HasSelectArrayOptions;


    case CENTER = 1;
    case HOME = 2;
}

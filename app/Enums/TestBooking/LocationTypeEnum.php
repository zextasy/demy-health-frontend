<?php

namespace App\Enums\TestBooking;

use ArchTech\Enums\Names;
use ArchTech\Enums\Values;
use ArchTech\Enums\Options;
use ArchTech\Enums\InvokableCases;

enum LocationTypeEnum: int
{
    use InvokableCases, Names, Values, Options;


    case Center = 1;
    case Home = 2;
}

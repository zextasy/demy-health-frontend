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


    case Center = 1;
    case Home = 2;
}

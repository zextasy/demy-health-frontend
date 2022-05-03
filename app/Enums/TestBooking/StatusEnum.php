<?php

namespace App\Enums\TestBooking;

use ArchTech\Enums\Names;
use ArchTech\Enums\Values;
use ArchTech\Enums\Options;
use ArchTech\Enums\InvokableCases;
use App\Traits\Enums\HasSelectArrayOptions;

enum StatusEnum: int
{
    use InvokableCases, Names, Values, Options, HasSelectArrayOptions;


    case Booked = 1;
    case Processing = 2;
}

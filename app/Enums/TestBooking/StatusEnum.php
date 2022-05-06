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
    case PaymentReceived = 2;
    case AwaitingSample = 3;
    case SampleReceived = 4;
    case Processing = 5;
    case Processed = 6;
}

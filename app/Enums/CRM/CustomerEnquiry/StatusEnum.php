<?php

namespace App\Enums\CRM\CustomerEnquiry;

use ArchTech\Enums\Names;
use ArchTech\Enums\Values;
use ArchTech\Enums\Options;
use ArchTech\Enums\InvokableCases;
use App\Traits\Enums\HasSelectArrayOptions;

enum StatusEnum: int
{
    use InvokableCases, Names, Values, Options, HasSelectArrayOptions;


    case Initiated = 1;
    case Assigned = 2;
    case AwaitingCustomerFeedback = 3;
    case Complete = 4;
}

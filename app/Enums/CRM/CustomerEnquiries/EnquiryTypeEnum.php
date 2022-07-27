<?php

namespace App\Enums\CRM\CustomerEnquiries;

use App\Traits\Enums\HasSelectArrayOptions;
use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Names;
use ArchTech\Enums\Options;
use ArchTech\Enums\Values;

enum EnquiryTypeEnum: int
{
    use InvokableCases, Names, Values, Options, HasSelectArrayOptions;

    //TODO delete this  and use standard enquiry workflow
    case GENERAL = 1;
    case QUOTE = 2;
    case OTHER = 100;
}

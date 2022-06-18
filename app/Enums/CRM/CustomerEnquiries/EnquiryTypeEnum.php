<?php

namespace App\Enums\CRM\CustomerEnquiries;

use ArchTech\Enums\Names;
use ArchTech\Enums\Values;
use ArchTech\Enums\Options;
use ArchTech\Enums\InvokableCases;
use App\Traits\Enums\HasSelectArrayOptions;

enum EnquiryTypeEnum: int
{
    use InvokableCases, Names, Values, Options, HasSelectArrayOptions;

//TODO delete this  and use standard enquiry workflow
    case GENERAL = 1;
    case QUOTE = 2;
    case OTHER = 100;
}

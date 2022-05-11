<?php

namespace App\Enums\CRM\CustomerEnquiry;

use ArchTech\Enums\Names;
use ArchTech\Enums\Values;
use ArchTech\Enums\Options;
use ArchTech\Enums\InvokableCases;
use App\Traits\Enums\HasSelectArrayOptions;

enum EnquiryTypeEnum: int
{
    use InvokableCases, Names, Values, Options, HasSelectArrayOptions;

//TODO delete this  and use standard enquiry workflow
    case General = 1;
    case LabSetUp = 2;
}

<?php

namespace App\Enums\Communication;

use App\Traits\Enums\HasSelectArrayOptions;
use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Names;
use ArchTech\Enums\Options;
use ArchTech\Enums\Values;

enum CommunicationChannelEnum: string
{
    use InvokableCases, Names, Values, Options, HasSelectArrayOptions;

    case EMAIL = 'mail';

    case SMS = 'sms';
}

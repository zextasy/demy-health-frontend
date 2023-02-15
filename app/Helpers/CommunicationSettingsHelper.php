<?php

namespace App\Helpers;

use App\Enums\Communication\CommunicationChannelEnum;

class CommunicationSettingsHelper
{
    public static function getMaximumSendRate(): int
    {
        return 12;
    }

    public static function maximumTriesForChannel(string|CommunicationChannelEnum $channel): int
    {
        return 5;
    }
}

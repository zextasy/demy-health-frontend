<?php

namespace App\Traits\Models;

use App\Enums\Communication\CommunicationChannelEnum;

trait RoutesCommunications
{
    public function routeNotificationForMail()
    {
        return $this->email;
    }

    public function routeNotificationForSMS()
    {
        return $this->phone_number;
    }

    public function hasValidRoute($channel): bool
    {
        return match ($channel) {
            CommunicationChannelEnum::EMAIL->value => !empty($this->routeNotificationForMail()),
            CommunicationChannelEnum::SMS->value => !empty($this->routeNotificationForSMS()),
            default => false,
        };
    }

}

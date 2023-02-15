<?php

namespace App\Contracts;

interface CommunicableContract
{
    public function notify($instance);
    public function routeNotificationForMail();
    public function hasValidRoute($channel): bool;

    public function routeNotificationForSMS();
}

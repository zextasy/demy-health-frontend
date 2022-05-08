<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public string $site_name;
    public string $default_prefix;
    public string $test_booking_prefix;
    public string $specimen_sample_prefix;

    public static function group(): string
    {
        return 'general';
    }
}

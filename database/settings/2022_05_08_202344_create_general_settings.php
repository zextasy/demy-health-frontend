<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateGeneralSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.site_name', 'DemyHealth');
        $this->migrator->add('general.default_prefix', 'DM-');
        $this->migrator->add('general.test_booking_prefix', 'DM-TB-');
        $this->migrator->add('general.specimen_sample_prefix', 'DM-SS-');
    }
}

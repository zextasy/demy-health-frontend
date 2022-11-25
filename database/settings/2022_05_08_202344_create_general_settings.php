<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateGeneralSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.site_name', 'DemyHealth');
        $this->migrator->add('general.logo_url', '/images/logo.png');
        $this->migrator->add('general.default_locale', 'en-US');
        $this->migrator->add('general.default_currency', 'NGN');
        $this->migrator->add('general.alternate_currency', 'NGN');
        $this->migrator->add('general.exchange_rate', 1);
        $this->migrator->add('general.default_timezone', 'en-US');
        $this->migrator->add('general.default_prefix', 'DM-');
        $this->migrator->add('general.test_booking_prefix', 'DM-TB-');
        $this->migrator->add('general.test_result_prefix', 'DM-RES-');
        $this->migrator->add('general.test_type_prefix', 'DM-GTL-TST-');
        $this->migrator->add('general.specimen_sample_prefix', 'DM-SS-');
        $this->migrator->add('general.product_sku_prefix', 'DM-PROD-');
        $this->migrator->add('general.order_prefix', 'DM-ORD-');
        $this->migrator->add('general.invoice_prefix', 'DM-INV-');
        $this->migrator->add('general.payment_prefix', 'DM-PAY-');
        $this->migrator->add('general.patient_prefix', 'DM-PAT-');
        $this->migrator->add('general.doctor_prefix', 'DM-DOC-');
        $this->migrator->add('general.prescription_prefix', 'DM-PRC-');
        $this->migrator->add('general.referral_code_prefix', 'DM-REF-CD-');
        $this->migrator->add('general.business_start_hour', '09:00:00');
        $this->migrator->add('general.business_end_hour', '17:00:00');
        $this->migrator->add('general.account_transfer_details', 'Fidelity bank, 000111111');
    }
}

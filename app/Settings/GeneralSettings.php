<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public string $site_name;

    public string $logo_url;

    public string $default_locale;

    public string $default_timezone;

    public string $default_currency;

    public string $alternate_currency;

    public float $exchange_rate;

    public string $default_prefix;

    public string $test_booking_prefix;

    public string $test_result_prefix;

    public string $test_type_prefix;

    public string $specimen_sample_prefix;

    public string $product_sku_prefix;

    public string $order_prefix;

    public string $invoice_prefix;

    public string $payment_prefix;

    public string $patient_prefix;

    public string $doctor_prefix;

    public string $prescription_prefix;

    public string $referral_code_prefix;

    public string $business_start_hour;

    public string $business_end_hour;

    public static function group(): string
    {
        return 'general';
    }
}

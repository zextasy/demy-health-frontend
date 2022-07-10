<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public string $site_name;
    public string $default_prefix;
    public string $test_booking_prefix;
    public string $test_result_prefix;
    public string $test_type_prefix;
    public string $specimen_sample_prefix;
    public string $product_sku_prefix;
    public string $order_prefix;
    public string $invoice_prefix;

    public $business_start_hour;
    public $business_end_hour;

    public static function group(): string
    {
        return 'general';
    }
}

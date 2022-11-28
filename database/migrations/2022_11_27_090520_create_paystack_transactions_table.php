<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paystack_transactions', function (Blueprint $table) {
            $table->id();

            $table->string('reference');
            $table->foreignId('payment_id')->nullable()->constrained('payments');
            $table->unsignedDecimal('amount', 12);
            $table->string('channel');
            $table->string('currency');
            $table->json('metadata');

            $table->timestamps();
        });
    }
    /**
     *array ( 'status' => true,'message' => 'Verification successful',
     * 'data' => array ( 'id' => 2317470650, 'domain' => 'test', 'status' => 'success', 'reference' => '26bb420ywb', 'amount' => 1870000, 'message' => NULL, 'gateway_response' => 'Successful', 'paid_at' => '2022-11-27T07:26:12.000Z', 'created_at' => '2022-11-27T07:26:06.000Z', 'channel' => 'card', 'currency' => 'NGN', 'ip_address' => '41.184.151.227',
     * 'metadata' => array ( 'invoice_reference' => 'DM-INV-000000012', ), 'log' => array ( 'start_time' => 1669533969, 'time_spent' => 4, 'attempts' => 1, 'errors' => 0, 'success' => true, 'mobile' => false, 'input' => array ( ), 'history' => array ( 0 => array ( 'type' => 'action', 'message' => 'Attempted to pay with card', 'time' => 2, ), 1 => array ( 'type' => 'success', 'message' => 'Successfully paid with card', 'time' => 4, ), ), ), 'fees' => 38050, 'fees_split' => NULL, 'authorization' => array ( 'authorization_code' => 'AUTH_oqw9s7xa0n', 'bin' => '408408', 'last4' => '4081', 'exp_month' => '12', 'exp_year' => '2030', 'channel' => 'card', 'card_type' => 'visa ', 'bank' => 'TEST BANK', 'country_code' => 'NG', 'brand' => 'visa', 'reusable' => true, 'signature' => 'SIG_plXtmBPIJcjBAlDykbg0', 'account_name' => NULL, 'receiver_bank_account_number' => NULL, 'receiver_bank' => NULL, ), 'customer' => array ( 'id' => 103826028, 'first_name' => NULL, 'last_name' => NULL, 'email' => 'ee@ww.com', 'customer_code' => 'CUS_kchlgr66bqoo7bp', 'phone' => NULL, 'metadata' => NULL, 'risk_action' => 'default', 'international_format_phone' => NULL, ), 'plan' => NULL, 'split' => array ( ), 'order_id' => NULL, 'paidAt' => '2022-11-27T07:26:12.000Z', 'createdAt' => '2022-11-27T07:26:06.000Z', 'requested_amount' => 1870000, 'pos_transaction_data' => NULL, 'source' => NULL, 'fees_breakdown' => NULL, 'transaction_date' => '2022-11-27T07:26:06.000Z', 'plan_object' => array ( ), 'subaccount' => array ( ), ), )
     *
     */

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paystack_transactions');
    }
};

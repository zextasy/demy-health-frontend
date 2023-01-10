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
        Schema::table('paystack_transactions', function (Blueprint $table) {
            $table->string('customer_email')->nullable();
            $table->json('customer')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('paystack_transactions', function (Blueprint $table) {
            if (Schema::hasColumn('paystack_transactions', 'customer')) {
                $table->dropColumn('customer');
            }
            if (Schema::hasColumn('paystack_transactions', 'customer_email')) {
                $table->dropColumn('customer_email');
            }
        });
    }
};

<?php

use App\Enums\Finance\Payments\PaymentMethodEnum;
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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_group_id')->references('id')->on('business_groups');
            $table->string('reference')->unique();
            $table->string('customer_email')->index();
            $table->unsignedTinyInteger('payment_method')->nullable();
            $table->nullableMorphs('invoiceable');
            $table->timestamp('sent_at')->nullable();
            $table->timestamp('payment_received_at')->nullable();
            $table->timestamp('payment_refunded_at')->nullable();
            $table->timestamp('credit_approved_at')->nullable();
            $table->foreignId('credit_approved_by')->nullable()->constrained('users');
            $table->timestamp('cancelled_at')->nullable();
            $table->foreignId('cancelled_by')->nullable()->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
};

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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_group_id')->references('id')->on('business_groups');
            $table->string('reference')->unique();
            $table->unsignedDecimal('amount', 12);
            $table->unsignedTinyInteger('payment_method')->default(PaymentMethodEnum::OTHER->value);
            $table->json('internal_references')->nullable();
            $table->string('external_reference')->nullable()->unique();
            $table->nullableMorphs('payer');
            $table->json('metadata')->nullable();
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
        Schema::dropIfExists('payments');
    }
};

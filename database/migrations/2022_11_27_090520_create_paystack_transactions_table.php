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

            $table->string('reference')->unique();
            $table->boolean('success');
            $table->unsignedDecimal('amount', 12);
            $table->string('status');
            $table->string('channel');
            $table->string('currency');
            $table->string('invoice_reference')->nullable()->index();
            $table->json('metadata');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('paystack_transactions');
    }
};

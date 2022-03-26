<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->foreignId('test_type_id')->constrained();
            $table->foreignId('user_id')->nullable()->constrained();
            $table->string('customer_email');
            $table->unsignedTinyInteger('location_type');//LocationTypeEnum
            $table->foreignId('test_center_id')->nullable()->constrained();
            $table->date('due_date');
            $table->time('start_time');
            $table->unsignedSmallInteger('duration_minutes')->default(15);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test_bookings');
    }
}

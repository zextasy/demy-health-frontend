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
            $table->foreignId('business_group_id')->references('id')->on('business_groups');
            $table->string('reference')->unique();
            $table->foreignId('test_type_id')->constrained();
            $table->unsignedTinyInteger('location_type'); //LocationTypeEnum
            $table->foreignId('test_center_id')->nullable()->constrained();
            $table->timestamp('due_date');
            $table->unsignedTinyInteger('duration_minutes')->default(10);
            $table->foreignId('patient_id')->constrained('patients');
            $table->string('customer_email')->nullable()->index();
            $table->string('customer_phone_number')->nullable()->index();
            $table->timestamp('payment_received_at')->nullable();
            $table->foreignId('payment_recorded_by')->nullable()->constrained('users', 'id');
            $table->timestamp('sample_collection_approved_at')->nullable();
            $table->foreignId('sample_collection_approved_by')->nullable()->constrained('users', 'id');
            $table->timestamp('sample_received_at')->nullable();
            $table->foreignId('sample_received_by')->nullable()->constrained('users', 'id');
            $table->timestamp('processing_initiated_at')->nullable();
            $table->foreignId('processing_initiated_by')->nullable()->constrained('users', 'id');
            $table->timestamp('processing_completed_at')->nullable();
            $table->foreignId('processing_completed_by')->nullable()->constrained('users', 'id');
            $table->timestamp('result_approved_at')->nullable();
            $table->foreignId('result_approved_by')->nullable()->constrained('users', 'id');
            $table->timestamp('sample_rejected_at')->nullable();
            $table->foreignId('sample_rejected_by')->nullable()->constrained('users', 'id');
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
        Schema::dropIfExists('test_bookings');
    }
}

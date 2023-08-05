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
        Schema::create('vital_signs_records', function (Blueprint $table) {
            $table->id();

			$table->foreignId('visit_id')->constrained('visits')->cascadeOnDelete();
	        $table->foreignId('patient_id')->constrained('patients')->cascadeOnDelete();
			$table->unsignedDecimal('height')->nullable();
			$table->unsignedDecimal('weight')->nullable();
			$table->unsignedDecimal('bmi')->nullable();
			$table->unsignedDecimal('body_temperature')->nullable();
			$table->unsignedDecimal('heart_rate')->nullable();
			$table->unsignedDecimal('respiratory_rate')->nullable();
			$table->unsignedDecimal('blood_pressure_systolic')->nullable();
			$table->unsignedDecimal('blood_pressure_diastolic')->nullable();

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
        Schema::dropIfExists('vital_signs_records');
    }
};

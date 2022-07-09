<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_types', function (Blueprint $table) {
            $table->id();
            $table->string('test_id')->unique();
            $table->string('name')->unique();
            $table->foreignId('test_category_id')->constrained();
            $table->boolean('should_call_in_for_details')->default(false);
            $table->integer('minimum_tat');
            $table->integer('maximum_tat');
            $table->integer('tat_hours')->default(0);
            $table->text('description')->nullable();
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
        Schema::dropIfExists('test_types');
    }
}

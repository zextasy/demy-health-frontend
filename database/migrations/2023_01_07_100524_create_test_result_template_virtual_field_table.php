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
        Schema::create('test_result_template_virtual_field', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('test_result_template_id');
            $table->unsignedBigInteger('virtual_field_id');
            $table->smallInteger('display_weight')->default(1);
            $table->tinyInteger('is_required')->default(false);
            $table->tinyInteger('is_searchable')->default(false);
            $table->tinyInteger('should_display_on_index')->default(false);
            $table->timestamps();

            $table->foreign('test_result_template_id', 't_t_v_f_t_r_test_result_template_id_foreign')
                ->references('id')
                ->on('test_result_templates')
                ->onDelete('cascade');
            $table->foreign('virtual_field_id', 't_t_v_f_t_r_virtual_field_id_foreign')
                ->references('id')
                ->on('virtual_fields')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test_result_template_virtual_field');
    }
};

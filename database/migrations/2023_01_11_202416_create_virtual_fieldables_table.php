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
        Schema::dropIfExists('test_result_template_virtual_field');
        Schema::create('virtual_fieldables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('virtual_field_id')->constrained('virtual_fields');
            $table->morphs('virtual_fieldable', 'virtual_fieldables_virtual_fieldable_morph_index');
            $table->smallInteger('display_weight')->default(1);
            $table->tinyInteger('is_required')->default(false);
            $table->tinyInteger('is_searchable')->default(false);
            $table->tinyInteger('should_display_on_index')->default(false);
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
        Schema::dropIfExists('virtual_fieldables');
    }
};

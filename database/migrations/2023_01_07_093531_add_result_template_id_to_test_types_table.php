<?php

use App\Models\TestResultTemplate;
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
        Schema::table('test_types', function (Blueprint $table) {
            $table->foreignId('test_result_template_id')->nullable()
                ->after('description')->constrained('test_result_templates');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('test_types', function (Blueprint $table) {
            if (Schema::hasColumn('test_types', 'test_result_template_id')) {
                $table->dropForeign(['test_result_template_id']);
                $table->dropColumn('test_result_template_id');
            }
        });
    }
};

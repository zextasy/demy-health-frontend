<?php

use App\Enums\Tasks\TaskActionEnum;
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
        Schema::table('tasks', function (Blueprint $table) {
            $table->unsignedSmallInteger('action')->default(TaskActionEnum::UNKNOWN->value)->after('assignable_url');
	        $table->string('actionable_url')->after('type')->nullable();
            $table->unsignedBigInteger('actionable_id')->after('type')->nullable();
            $table->string('actionable_type')->after('type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
	        if (Schema::hasColumn('tasks', 'action')){
		        $table->dropColumn('action');
	        }
            if (Schema::hasColumn('tasks', 'actionable_url')){
                $table->dropColumn('actionable_url');
            }
            if (Schema::hasColumn('tasks', 'actionable_id')){
                $table->dropColumn('actionable_id');
            }
	        if (Schema::hasColumn('tasks', 'actionable_type')){
		        $table->dropColumn('actionable_type');
	        }
        });
    }
};

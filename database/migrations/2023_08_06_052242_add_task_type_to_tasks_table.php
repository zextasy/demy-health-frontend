<?php

use App\Enums\Tasks\TaskTypeEnum;
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
            $table->unsignedSmallInteger('type')->default(TaskTypeEnum::GENERIC->value)->after('assignable_url');
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
			if (Schema::hasColumn('tasks', 'type')){
				$table->dropColumn('type');
			}

        });
    }
};

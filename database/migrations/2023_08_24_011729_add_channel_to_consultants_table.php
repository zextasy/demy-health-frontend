<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\Consultations\ConsultationChannelEnum;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('consultants', function (Blueprint $table) {
            $table->unsignedSmallInteger('channel')->default(ConsultationChannelEnum::NONE->value)->after('due_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('consultants', function (Blueprint $table) {
            if (Schema::hasColumn('consultants', 'channel')){
                $table->dropColumn('channel');
            }
        });
    }
};

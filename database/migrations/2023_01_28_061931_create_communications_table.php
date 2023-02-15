<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\Communication\CommunicationStatusEnum;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('communications', function (Blueprint $table) {
            $table->id();
            $table->morphs('communication');
            $table->morphs('communicable');
            $table->unsignedSmallInteger('status')->default(CommunicationStatusEnum::PENDING());
            $table->unsignedTinyInteger('tries')->default(0);
            $table->timestamp('last_tired_at')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->timestamp('resend_at')->nullable();
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
        Schema::dropIfExists('communications');
    }
};

<?php

use App\Enums\AgeClassificationEnum;
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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_group_id')->references('id')->on('business_groups');
            $table->string('reference')->unique();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('email')->nullable()->unique();
            $table->string('phone_number')->nullable()->unique();
            $table->unsignedTinyInteger('gender');//GenderEnum
            $table->string('passport_number')->nullable()->unique();
            $table->foreignId('country_id')->nullable()->references('id')->on('countries');
            $table->date('date_of_birth')->nullable();
            $table->unsignedSmallInteger('age_classification')->default(AgeClassificationEnum::ADULT->value);
            $table->unsignedTinyInteger('height')->nullable();
            $table->unsignedTinyInteger('weight')->nullable();

            $table->foreignId('referral_channel')->nullable()->constrained('referral_channels');//GenderEnum
            $table->string('referral_code')->nullable()->unique();
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
        Schema::dropIfExists('patients');
    }
};

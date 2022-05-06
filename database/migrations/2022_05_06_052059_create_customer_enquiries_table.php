<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\CRM\CustomerEnquiry\StatusEnum;
use App\Enums\CRM\CustomerEnquiry\EnquiryTypeEnum;

class CreateCustomerEnquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_enquiries', function (Blueprint $table) {
            $table->id();
            $table->string('customer_email');
            $table->string('customer_name');
            $table->string('customer_phone')->nullable();
            $table->text('customer_message');
            $table->unsignedSmallInteger('type')->default(EnquiryTypeEnum::General->value);
            $table->unsignedSmallInteger('status')->default(StatusEnum::Initiated->value);
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
        Schema::dropIfExists('customer_enquiries');
    }
}

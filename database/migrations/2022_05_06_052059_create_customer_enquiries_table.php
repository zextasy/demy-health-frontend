<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Enums\CRM\CustomerEnquiry\EnquiryTypeEnum;

class CreateCustomerEnquiriesTable extends Migration
{
    /**
     * Run the migrations.
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
            $table->unsignedSmallInteger('type')->default(EnquiryTypeEnum::GENERAL->value);
            $table->timestamp('latest_response_sent_at')->nullable();
            $table->foreignId('latest_response_sent_by')->nullable()->constrained('users', 'id');
            $table->timestamp('latest_customer_response_received_at')->nullable();
            $table->foreignId('latest_action_by')->nullable()->constrained('users', 'id');
            $table->timestamp('resolved_at')->nullable();
            $table->foreignId('resolved_by')->nullable()->constrained('users', 'id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_enquiries');
    }
}

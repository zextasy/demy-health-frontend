<?php

use App\Enums\CRM\CustomerEnquiries\EnquiryTypeEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->foreignId('business_group_id')->references('id')->on('business_groups');
            $table->string('customer_email');
            $table->string('customer_name');
            $table->string('customer_phone')->nullable();
            $table->text('customer_message');
            $table->unsignedTinyInteger('type')->default(EnquiryTypeEnum::GENERAL->value);
            $table->timestamp('latest_response_sent_at')->nullable();
            $table->foreignId('latest_response_sent_by')->nullable()->constrained('users', 'id');
            $table->timestamp('latest_customer_response_received_at')->nullable();
            $table->foreignId('latest_action_by')->nullable()->constrained('users', 'id');
            $table->timestamp('resolved_at')->nullable();
            $table->foreignId('resolved_by')->nullable()->constrained('users', 'id');
            $table->string('resolution_notes')->nullable();
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

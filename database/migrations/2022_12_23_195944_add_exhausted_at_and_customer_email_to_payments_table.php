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
        Schema::table('payments', function (Blueprint $table) {
            $table->timestamp('exhausted_at')->after('metadata')->nullable();
            $table->string('customer_email')->after('external_reference')->nullable()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            if (Schema::hasColumn('payments', 'exhausted_at')) {
                $table->dropColumn('exhausted_at');
            }

            if (Schema::hasColumn('payments', 'customer_email')) {
                $table->dropColumn('customer_email');
            }
        });
    }
};

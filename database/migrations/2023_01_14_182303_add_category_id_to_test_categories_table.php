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
        Schema::table('test_categories', function (Blueprint $table) {
            $table->foreignId('test_category_id')->nullable()->references('id')->on('test_categories');
        });
        Schema::table('product_categories', function (Blueprint $table) {
            $table->foreign('product_category_id')->references('id')->on('product_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('test_categories', function (Blueprint $table) {
            if (Schema::hasColumn('test_categories', 'test_category_id')) {
                $table->dropForeign(['test_category_id']);
                $table->dropColumn('test_category_id');
            }
        });
        Schema::table('product_categories', function (Blueprint $table) {
            $table->dropForeign(['product_category_id']);
        });
    }
};

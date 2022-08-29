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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->nullable()->references('id')->on('tasks');
            $table->foreignId('business_group_id')->references('id')->on('business_groups');
            $table->text('details');
            $table->timestamp('due_at');
            $table->morphs('assignable');
            $table->text('assignable_url');
            $table->timestamp('assigned_at');
            $table->foreignId('assigned_by')->constrained('users', 'id');
            $table->foreignId('assigned_to')->constrained('users', 'id');
            $table->timestamp('started_at')->nullable();
            $table->foreignId('started_by')->nullable()->constrained('users', 'id');
            $table->timestamp('completion_confirmation_requested_at')->nullable();
            $table->foreignId('completion_confirmation_requested_by')->nullable()->constrained('users', 'id');
            $table->timestamp('completion_confirmation_confirmed_at')->nullable();
            $table->foreignId('completion_confirmation_confirmed_by')->nullable()->constrained('users', 'id');
            $table->timestamp('completion_confirmation_rejected_at')->nullable();
            $table->foreignId('completion_confirmation_rejected_by')->nullable()->constrained('users', 'id');
            $table->timestamp('completed_at')->nullable();
            $table->foreignId('completed_by')->nullable()->constrained('users', 'id');
            $table->timestamp('failed_at')->nullable();
            $table->foreignId('failed_by')->nullable()->constrained('users', 'id');
            $table->tinyInteger('completion_rating')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
};

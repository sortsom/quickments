<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('request_leaves', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('member_id');
            $table->integer('date');    
            $table->date('start_time');
            $table->date('end_time');
            $table->enum('type', ['full_day','half_day_morning','half_day_afternoon'])->default('full_day');
            $table->text('reason')->nullable();
            $table->string('photo')->nullable();
            $table->integer('status_id')->default(0);
            $table->integer('type_leave');
            $table->integer('approve_by')->nullable();
            $table->datetime('approve_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_leaves');
    }
};

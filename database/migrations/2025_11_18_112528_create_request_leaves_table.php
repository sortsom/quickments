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
            $table->integer('member_id');
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->enum('type', ['full_day','half_day_morning','half_day_afternoon'])->default('full_day');
            $table->text('reason')->nullable();
            $table->string('photo');
            $table->integer('status')->default(0);
            $table->integer('type_leave');
            $table->integer('approve_by');
            $table->datetime('approve_date');
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

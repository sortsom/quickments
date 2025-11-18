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
        Schema::create('attendance_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('attendance_id');
            $table->time('clock'); // e.g., 'check_in', 'check_out'
            $table->integer('check_type'); // 1 for check-in, 2 for check-out
            $table->enum('status', ['Good', 'Late', 'Early'])->default('Good');
 // e.g., 1 for on-time, 2 for late
            $table->string('reason')->nullable();
            $table->integer('count_time'); // e.g., minutes late or early
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance_details');
    }
};

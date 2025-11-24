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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('member_id');
            $table->time('start_time');
            $table->time('end_time');
            $table->time('start_time2')->nullable();
            $table->time('end_time2')->nullable();
            $table->date('date');
            $table->string('status');
            $table->integer('half_time');
            $table->tinyInteger('half_time')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};

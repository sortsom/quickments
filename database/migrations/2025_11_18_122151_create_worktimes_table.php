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
        Schema::create('worktimes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('member_id');
            $table->unsignedBigInteger('week_id');
            $table->time('start_time');
            $table->time('end_time');
            $table->time('start_time2')->nullable();
            $table->time('end_time2')->nullable();
            $table->integer('half_day')->default(0);
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
            $table->foreign('week_id')->references('id')->on('weeklies')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('worktimes');
    }
};

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
        Schema::create('overtime_works', function (Blueprint $table) {
    $table->id();
    $table->integer('member_id');
    $table->date('date');
    $table->time('start_time');
    $table->time('end_time');
    $table->text('reason')->nullable();
    $table->string('photo')->nullable();
    $table->integer('status')->default(0);
    $table->integer('approve_by')->nullable();
    $table->dateTime('approve_date')->nullable();
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('overtime_works');
    }
};
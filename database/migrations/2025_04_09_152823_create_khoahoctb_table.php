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
        Schema::create('khoahoctb', function (Blueprint $table) {
            $table->id();
            $table->string('ma');
            $table->string('ten');
            $table->string('giangvien')->nullable();
            $table->integer('sobaihoc')->nullable(); 
            $table->string('anh')->nullable();  
            $table->string('meet_link')->nullable();      // Link Google Meet
            $table->string('meet_time')->nullable();      // Thời gian học   
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('khoahoctb');
    }
};

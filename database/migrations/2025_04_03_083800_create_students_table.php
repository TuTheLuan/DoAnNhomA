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
        Schema::create('students', function (Blueprint $table) {
            $table->id('MaHV'); // Mã học viên (ID chính)
            $table->string('HoTen', 100); // Họ và tên
            $table->string('GioiTinh', 10); // Giới tính
            $table->string('Email', 100); // Email
            $table->string('DiaChi', 100)->nullable(); // Địa chỉ (có thể null)
            $table->timestamps(); // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};

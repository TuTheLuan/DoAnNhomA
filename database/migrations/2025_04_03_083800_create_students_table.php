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
            $table->id('id'); // Mã học viên (ID chính)
            $table->string('ho_ten', 100); // Họ và tên
            $table->string('gioi_tinh', 10); // Giới tính
            $table->string('email', 100); // Email
            $table->string('dia_chi', 100)->nullable(); // Địa chỉ (có thể null)
            $table->boolean('trang_thai')->default(0); // Thêm cột trang_thai
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

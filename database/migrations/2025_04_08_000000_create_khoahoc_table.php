<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('ma_khoa_hoc', 20)->unique();
            $table->string('ten_khoa_hoc', 100);
            $table->text('mo_ta')->nullable();
            $table->integer('so_luong_sinh_vien');
            $table->string('trang_thai', 20)->default('mo');
            $table->foreignId('teacher_id')->constrained('teachers');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('courses');
    }
};

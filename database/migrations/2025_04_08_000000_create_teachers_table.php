<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id('id');
            $table->string('ma_giang_vien', 20)->unique();
            $table->string('ho_ten', 100);
            $table->string('gioi_tinh', 10);
            $table->string('email')->unique();
            $table->string('dia_chi', 100)->nullable();
            $table->string('so_dien_thoai', 11);
            $table->boolean('trang_thai')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('teachers');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('diendan', function (Blueprint $table) {
            $table->id();
            $table->string('ma_dien_dan', 20)->unique();
            $table->string('ten_dien_dan');
            $table->enum('loai_thao_luan', ['public', 'anonymous'])->default('public');
            $table->date('ngay_tao');
            $table->string('ten_giang_vien');
            $table->string('background_image')->nullable();
            $table->json('images')->nullable(); // Thêm trường lưu nhiều ảnh dạng JSON
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('diendan');
    }
};

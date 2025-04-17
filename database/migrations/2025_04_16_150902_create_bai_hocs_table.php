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
        Schema::create('bai_hocs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('khoahoc_id'); // ID khóa học liên kết
            $table->integer('so'); // Số thứ tự bài học
            $table->string('tieude'); // Tiêu đề bài học
            $table->string('file')->nullable(); // Tài liệu đính kèm (nếu có)
            $table->timestamps();

            // Ràng buộc khóa ngoại
            $table->foreign('khoahoc_id')
                  ->references('id')
                  ->on('khoa_hocs')
                  ->onDelete('cascade'); // Xóa khóa học thì xóa luôn bài học
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bai_hocs');
    }
};

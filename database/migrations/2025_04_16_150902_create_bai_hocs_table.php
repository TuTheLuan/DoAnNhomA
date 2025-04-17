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
            $table->unsignedBigInteger('khoahoc_id'); // <== thêm dòng này
            $table->integer('so'); // Số bài học
            $table->string('tieude'); // Tiêu đề bài học
            $table->string('file')->nullable(); // Tài liệu đính kèm
            $table->timestamps();

            // Nếu muốn ràng buộc foreign key:
            // $table->foreign('khoahoc_id')->references('id')->on('khoa_hocs')->onDelete('cascade');
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

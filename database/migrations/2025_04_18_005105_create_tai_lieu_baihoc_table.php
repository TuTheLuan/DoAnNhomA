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
        Schema::create('tai_lieu_baihoc', function (Blueprint $table) {
            $table->id();
            $table->foreignId('baihoc_id')->constrained('bai_hocs')->onDelete('cascade'); // sửa tại đây
            $table->string('file');
            $table->string('original_name')->nullable(); // Thêm dòng này
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tai_lieu_baihoc');
    }
};

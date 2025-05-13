<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('thongbao', function (Blueprint $table) {
            $table->id();
            $table->string('tieu_de');
            $table->text('noi_dung')->nullable();
            $table->date('ngay_tao')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('thongbao');
    }
};

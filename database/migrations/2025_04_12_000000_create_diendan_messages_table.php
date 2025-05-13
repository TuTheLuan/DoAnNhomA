<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiendanMessagesTable extends Migration
{
    public function up()
    {
        Schema::create('diendan_messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('diendan_id');
            $table->string('student_name')->nullable();
            $table->text('content');
            $table->timestamps();

            $table->foreign('diendan_id')->references('id')->on('diendan')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('diendan_messages');
    }
}

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
        Schema::table('khoahoctb', function (Blueprint $table) {
            $table->string('anh')->nullable()->after('giangvien');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('khoahoctb', function (Blueprint $table) {
            $table->dropColumn('anh');
        });
    }
};

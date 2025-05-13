<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Set default role to 'student' for users with null role
        DB::table('users')->whereNull('role')->update(['role' => 'student']);

        // Set default username to 'user' + id for users with null username
        $users = DB::table('users')->whereNull('username')->get();

        foreach ($users as $user) {
            DB::table('users')->where('id', $user->id)->update([
                'username' => 'user' . $user->id,
            ]);
        }
    }

    public function down()
    {
        // No rollback needed
    }
};

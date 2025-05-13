<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'username' => 'adminuser',
                'email' => 'admin@example.com',
                'password' => Hash::make('Admin@123'),
                'role' => 'admin',
                'status' => 'approved',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'teacher1',
                'email' => 'teacher1@example.com',
                'password' => Hash::make('Teacher@123'),
                'role' => 'teacher',
                'status' => 'approved',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'student1',
                'email' => 'student1@example.com',
                'password' => Hash::make('Student@123'),
                'role' => 'student',
                'status' => 'approved',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

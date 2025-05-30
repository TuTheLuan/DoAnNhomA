<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class StudentsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('vi_VN');

        for ($i = 1; $i <= 100; $i++) {
            $user = User::create([
                'username' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'),
                'role' => 'student',
            ]);

            Student::create([
                'user_id' => $user->id,
                'ho_ten' => $user->username,
                'gioi_tinh' => $faker->randomElement(['Nam', 'Nữ']),
                'email' => $user->email,
                'dia_chi' => $faker->address,
                'trang_thai' => true,
            ]);
        }
    }
}

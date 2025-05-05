<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use Faker\Factory as Faker;

class StudentsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('vi_VN');

        for ($i = 1; $i <= 100; $i++) {
            Student::create([
                'ho_ten' => $faker->name,
                'gioi_tinh' => $faker->randomElement(['Nam', 'Nữ']),
                'email' => $faker->unique()->safeEmail,
                'dia_chi' => $faker->address,
            ]);
        }
    }
}

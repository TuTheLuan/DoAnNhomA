<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\DiemBaiTap;
use App\Models\DiemThi;

class DiemSeeder extends Seeder
{
    public function run()
    {
        $students = Student::all();

        foreach ($students as $student) {
            // Tạo 5 bài tập
            for ($i = 1; $i <= 5; $i++) {
                DiemBaiTap::create([
                    'student_id' => $student->id,
                    'bai_so' => $i,
                    'diem' => rand(0, 10), // hoặc có thể dùng: rand(0, 100)/10
                ]);
            }

            // Tạo điểm thi
            DiemThi::create([
                'student_id' => $student->id,
                'diem' => rand(0, 10),
            ]);
        }
    }
}

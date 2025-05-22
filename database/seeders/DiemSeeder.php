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
        // Lấy 100 học viên đầu tiên (nếu có ít hơn 100 học viên thì lấy tất cả)
        $students = Student::limit(100)->get();

        foreach ($students as $student) {
            // Tạo 5 bài tập với điểm ngẫu nhiên từ 0 đến 10
            for ($i = 1; $i <= 5; $i++) {
                DiemBaiTap::create([
                    'student_id' => $student->id,
                    'bai_so' => $i,
                    'diem' => rand(0, 10),
                ]);
            }

            // Tạo điểm thi với điểm ngẫu nhiên từ 0 đến 10
            DiemThi::create([
                'student_id' => $student->id,
                'diem' => rand(0, 10),
            ]);
        }
    }
}

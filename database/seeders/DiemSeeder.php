<?php

namespace Database\Seeders;

use App\Models\KhoaHoc;
use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\DiemBaiTap;
use App\Models\DiemThi;

class DiemSeeder extends Seeder
{
    public function run()
    {
        // Lấy danh sách khóa học có sẵn
        $khoaHocs = KhoaHoc::all();

        // Tạo 100 học viên
        for ($i = 1; $i <= 100; $i++) {
            $student = Student::create([
                'ho_ten' => 'Học viên ' . $i,
                'email' => 'hocvien' . $i . '@example.com',
                'gioi_tinh' => $i % 2 === 0 ? 'Nam' : 'Nữ',
                'dia_chi' => 'Địa chỉ ' . $i,
                'trang_thai' => true,
            ]);

            // Gán học viên vào 1 hoặc 2 khóa học ngẫu nhiên
            $selectedKhoaHocs = $khoaHocs->random(rand(1, min(2, count($khoaHocs))));
            foreach ($selectedKhoaHocs as $khoaHoc) {
                DB::table('user_khoahoc')->insert([
                    'user_id' => $student->id,
                    'khoahoc_id' => $khoaHoc->id,
                ]);

                // Tạo điểm bài tập (5 bài, điểm từ 0 đến 10)
                for ($bai = 1; $bai <= 5; $bai++) {
                    DiemBaiTap::create([
                        'student_id' => $student->id,
                        'khoahoc_id' => $khoaHoc->id,
                        'bai_so' => $bai,
                        'diem' => rand(0, 10),
                    ]);
                }

                // Tạo điểm thi
                DiemThi::create([
                    'student_id' => $student->id,
                    'khoahoc_id' => $khoaHoc->id,
                    'diem' => rand(0, 10),
                ]);
            }
        }
    }
}

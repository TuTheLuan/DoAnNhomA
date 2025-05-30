<?php

namespace Database\Seeders;

use App\Models\KhoaHoc;
use App\Models\Student;
// Remove User and Hash imports as we are not creating new users
// use App\Models\User;
// use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\DiemBaiTap;
use App\Models\DiemThi;

class DiemSeeder extends Seeder
{
    public function run()
    {
        // Lấy danh sách khóa học và học viên có sẵn
        $khoaHocs = KhoaHoc::all();
        $students = Student::all();

        if ($khoaHocs->isEmpty()) {
            $this->command->info('No courses found. Please run KhoaHocTableSeeder first.');
            return;
        }

        if ($students->isEmpty()) {
            $this->command->info('No students found. Please run StudentsTableSeeder or UsersTableSeeder first if students are created via users.');
            return;
        }

        // Xóa dữ liệu cũ trong các bảng liên quan để tránh trùng lặp khi chạy lại seeder
        DB::table('user_khoahoc')->truncate();
        DiemBaiTap::truncate();
        DiemThi::truncate();

        // Gán các học viên có sẵn vào các khóa học có sẵn và tạo điểm
        foreach ($students as $student) {
            // Gán học viên vào 1 hoặc 2 khóa học ngẫu nhiên từ danh sách có sẵn
            $selectedKhoaHocs = $khoaHocs->random(rand(1, min(2, $khoaHocs->count())));
            foreach ($selectedKhoaHocs as $khoaHoc) {
                // Check if the relationship already exists to avoid duplicates on multiple runs without truncate
                $exists = DB::table('user_khoahoc')
                            ->where('user_id', $student->user_id) // Assuming student has user_id
                            ->where('khoahoc_id', $khoaHoc->id)
                            ->exists();

                if (!$exists) {
                    DB::table('user_khoahoc')->insert([
                        'user_id' => $student->user_id, // Use the user_id from the existing student
                        'khoahoc_id' => $khoaHoc->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }

         // Tạo điểm bài tập và điểm thi cho TẤT CẢ các khóa học mà học viên đã tham gia
        $userKhoaHocEntries = DB::table('user_khoahoc')->get();

        foreach ($userKhoaHocEntries as $entry) {
            $student = Student::where('user_id', $entry->user_id)->first();
            $khoaHocId = $entry->khoahoc_id;
            $studentId = $student->id; // Lấy student_id từ model Student

            // Tạo điểm bài tập (5 bài, điểm từ 0 đến 10) cho học viên trong khóa học này
            for ($bai = 1; $bai <= 5; $bai++) {
                 $diemBaiTapExists = DiemBaiTap::where('student_id', $studentId)
                                             ->where('khoahoc_id', $khoaHocId)
                                             ->where('bai_so', $bai)
                                             ->exists();
                if (!$diemBaiTapExists) {
                    DiemBaiTap::create([
                        'student_id' => $studentId, // Use the student_id
                        'khoahoc_id' => $khoaHocId,
                        'bai_so' => $bai,
                        'diem' => rand(0, 10),
                    ]);
                }
            }

            // Tạo điểm thi cho học viên trong khóa học này
             $diemThiExists = DiemThi::where('student_id', $studentId)
                                 ->where('khoahoc_id', $khoaHocId)
                                 ->exists();
            if (!$diemThiExists) {
                DiemThi::create([
                    'student_id' => $studentId, // Use the student_id
                    'khoahoc_id' => $khoaHocId,
                    'diem' => rand(0, 10),
                ]);
            }
        }

        // Ensure course with ID 1 has some students (if it exists)
        $course1 = KhoaHoc::find(1);
        if ($course1 && !$students->isEmpty()) {
            // Take the first few students (e.g., first 10) and attach them to course 1
            $studentsToAttach = $students->take(10);

            foreach ($studentsToAttach as $student) {
                 // Check if the relationship already exists
                $exists = DB::table('user_khoahoc')
                            ->where('user_id', $student->user_id)
                            ->where('khoahoc_id', $course1->id)
                            ->exists();

                if (!$exists) {
                    DB::table('user_khoahoc')->insert([
                        'user_id' => $student->user_id,
                        'khoahoc_id' => $course1->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
                 // Optionally, create some sample scores for these students in course 1
                 // This part depends on whether you want guaranteed scores for these students
                 // For now, let's focus on just attaching them to the course
            }
             $this->command->info('Ensured course with ID 1 has some students.');
        }
    }
}

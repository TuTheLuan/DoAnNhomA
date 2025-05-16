<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\KhoaHoc;
use App\Models\DiemThi;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function thongke()
    {
        $students = Student::with(['diemBaiTap', 'diemThi'])->get();
        $tongHocVien = $students->count();
        $tongKhoaHoc = KhoaHoc::count();
        $tongBaiThiHoanThanh = 0;

        $bangDiem = [];

        foreach ($students as $student) {
            $baiTap = $student->diemBaiTap ?? collect();
            $diemThi = optional($student->diemThi)->diem ?? null;

            // Đếm số bài tập có điểm (tức là đã hoàn thành)
            $tongBaiThiHoanThanh += $baiTap->filter()->count();

            // Lấy mảng điểm bài tập theo thứ tự chỉ số
            $diemBaiTap = [];
            foreach ($baiTap as $index => $diem) {
                $diemBaiTap[$index + 1] = $diem->diem ?? null;
            }

            $bangDiem[] = [
                'ma_hoc_vien' => $student->ma_hoc_vien,
                'ten' => $student->name,
                'diem_bai_tap' => $diemBaiTap,
                'diem_thi' => $diemThi,
            ];
        }

        return view('students.thongke', compact(
            'tongHocVien', 'tongKhoaHoc', 'tongBaiThiHoanThanh', 'bangDiem'
        ));
    }
}

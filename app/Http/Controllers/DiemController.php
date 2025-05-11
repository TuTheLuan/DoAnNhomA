<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KhoaHoc;
use App\Models\Student;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DiemExport;

class DiemController extends Controller
{
    public function xemDiem($khoahocId)
    {
        $khoahoc = KhoaHoc::findOrFail($khoahocId);

        // Lấy danh sách học viên chưa rút khỏi khóa học
        $students = Student::where('trang_thai', true)->get();

        // Lấy dữ liệu điểm bài tập và điểm thi (giả sử có các quan hệ hoặc bảng điểm)
        // Đây là ví dụ giả định, bạn cần thay thế bằng logic thực tế
        $diemBaiTap = []; // Lấy điểm bài tập cho từng học viên
        $diemThi = [];    // Lấy điểm thi cho từng học viên

        return view('teacher.diem', compact('khoahoc', 'students', 'diemBaiTap', 'diemThi'));
    }

    public function xuatExcel($khoahocId)
    {
        return Excel::download(new DiemExport($khoahocId), 'diem_khoahoc_' . $khoahocId . '.xlsx');
    }

    public function thoat()
    {
        return redirect()->back();
    }
}

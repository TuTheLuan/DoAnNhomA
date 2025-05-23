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

        // Lấy user_id của học viên trong khóa học
        $userIds = \DB::table('user_khoahoc')
            ->where('khoahoc_id', $khoahocId)
            ->pluck('user_id');

        // Lấy học viên tương ứng trong bảng students (giả định user_id = student_id)
        $students = Student::whereIn('id', $userIds)
            ->where('trang_thai', true)
            ->get();

        // Lấy điểm bài tập cho từng học viên
        $diemBaiTapRaw = \DB::table('diem_bai_taps')
            ->whereIn('student_id', $userIds)
            ->get();

        $diemBaiTap = [];
        foreach ($diemBaiTapRaw as $item) {
            $diemBaiTap[$item->student_id][$item->bai_so] = $item->diem;
        }

        // Lấy điểm thi cho từng học viên
        $diemThiRaw = \DB::table('diem_this')
            ->whereIn('student_id', $userIds)
            ->get();

        $diemThi = [];
        foreach ($diemThiRaw as $item) {
            $diemThi[$item->student_id] = $item->diem;
        }

        return view('teacher.diem', compact('khoahoc', 'students', 'diemBaiTap', 'diemThi'));
    }

    public function xuatExcel($khoahocId)
    {
        return \Maatwebsite\Excel\Facades\Excel::download(new DiemExport($khoahocId), 'diem_khoahoc_' . $khoahocId . '.xlsx');
    }

    public function thoat()
    {
        return redirect()->back();
    }
}

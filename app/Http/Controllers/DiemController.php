<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KhoaHoc;
use App\Models\Student;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DiemExport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Exception;

class DiemController extends Controller
{
    public function xemDiem(Request $request, $khoahocId)
    {
        try {
            $khoahoc = KhoaHoc::findOrFail($khoahocId);

            // Query cơ bản để lấy học viên
            $query = Student::query()
                ->join('user_khoahoc', 'students.user_id', '=', 'user_khoahoc.user_id')
                ->where('user_khoahoc.khoahoc_id', $khoahocId)
                ->where('students.trang_thai', true);

            // Tìm kiếm theo tên học viên
            if ($request->has('ten_hoc_vien') && !empty($request->ten_hoc_vien)) {
                $query->where('students.name', 'like', '%' . trim($request->ten_hoc_vien) . '%');
            }

            // Tìm kiếm theo email
            if ($request->has('email') && !empty($request->email)) {
                $query->where('students.email', 'like', '%' . trim($request->email) . '%');
            }

            // Tìm kiếm theo điểm (từ ... đến ...)
            if ($request->has('diem_tu') && is_numeric($request->diem_tu)) {
                $query->whereHas('diemThis', function($q) use ($request) {
                    $q->where('diem', '>=', $request->diem_tu);
                });
            }
            if ($request->has('diem_den') && is_numeric($request->diem_den)) {
                $query->whereHas('diemThis', function($q) use ($request) {
                    $q->where('diem', '<=', $request->diem_den);
                });
            }

            // Phân trang kết quả
            $students = $query->paginate(20);
            // Thêm dòng debug để kiểm tra dữ liệu học viên
            // dd($students);
            $studentIds = $students->pluck('id')->toArray();

            // Lấy điểm bài tập
            $diemBaiTapRaw = DB::table('diem_bai_taps')
                ->whereIn('student_id', $studentIds)
                ->get();

            $diemBaiTap = [];
            foreach ($diemBaiTapRaw as $item) {
                $diemBaiTap[$item->student_id][$item->bai_so] = $item->diem;
            }

            // Lấy điểm thi
            $diemThiRaw = DB::table('diem_this')
                ->whereIn('student_id', $studentIds)
                ->get();

            $diemThi = [];
            foreach ($diemThiRaw as $item) {
                $diemThi[$item->student_id] = $item->diem;
            }

            return view('teacher.diem', compact('khoahoc', 'students', 'diemBaiTap', 'diemThi'));

        } catch (Exception $e) {
            return back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function xuatExcel($khoahocId)
    {
        try {
            // Kiểm tra khóa học tồn tại
            $khoahoc = KhoaHoc::findOrFail($khoahocId);

            // Kiểm tra có học viên trong khóa học
            $hasStudents = DB::table('user_khoahoc')
                ->where('khoahoc_id', $khoahocId)
                ->exists();

            if (!$hasStudents) {
                return back()->with('error', 'Không có học viên nào trong khóa học này');
            }

            // Tạo tên file an toàn bằng Str::slug
            $filename = 'diem_' . Str::slug($khoahoc->ten_khoa_hoc, '_') . '_' . date('Y-m-d_H-i') . '.xlsx';
            
            return Excel::download(new DiemExport($khoahocId), $filename);

        } catch (Exception $e) {
            return back()->with('error', 'Không thể xuất file Excel: ' . $e->getMessage());
        }
    }

    public function thoat()
    {
        return redirect()->back();
    }
}

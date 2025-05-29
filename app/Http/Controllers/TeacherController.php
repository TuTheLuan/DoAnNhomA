<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KhoaHoc;
use App\Models\BaiHoc;
use App\Models\Student;
use App\Models\Diendan;
use App\Models\ThongBao;

class TeacherController extends Controller
{
    public function home()
    {
        $soKhoaHoc = KhoaHoc::count();
        $soDienDan = Diendan::count();
        $soHocVien = Student::count();
        $thongBaoMoiNhat = ThongBao::orderBy('created_at', 'desc')->take(5)->get();

        return view('teacher.home', compact('soKhoaHoc', 'soDienDan', 'soHocVien', 'thongBaoMoiNhat'));
    }

    public function courses()
    {
        return view('user/thongbao');
    }

    public function thongbao()
    {
        $thongBaoMoiNhat = \App\Models\ThongBao::orderBy('created_at', 'desc')->get();
        return view('user.thongbao', compact('thongBaoMoiNhat'));
    }

    public function classes()
    {
        return view('user/thongbao');
    }

    public function notifications()
    {
        return view('user/thongbao');
    }

    public function profile()
    {
        return view('user/thongbao');
    }

    public function myCourses()
    {
        return view('user/thongbao');
    }

    public function khoahoc(Request $request)
    {
        $query = KhoaHoc::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('ten', 'like', "%$search%")
                  ->orWhere('ma', 'like', "%$search%")
                  ->orWhere('giangvien', 'like', "%$search%") ;
            });
        }

        if ($request->filled('giangvien')) {
            $query->where('giangvien', $request->giangvien);
        }

        $khoahoctb = $query->paginate(10)->withQueryString();
        $tatcaGiangVien = KhoaHoc::select('giangvien')->distinct()->pluck('giangvien');
        return view('teacher.khoahoc.danhsach', compact('khoahoctb', 'tatcaGiangVien'));
    }

    public function createCourse()
    {
        return view('teacher.khoahoc.themkhoahoc');
    }

    public function storeCourse(Request $request)
    {
        // Xử lý thêm khóa học
        // Tạo mã khóa học tự động
        $lastKhoaHoc = \App\Models\KhoaHoc::orderBy('id', 'desc')->first();
        $newCode = $lastKhoaHoc ? 'KH' . str_pad((int) substr($lastKhoaHoc->ma, 2) + 1, 3, '0', STR_PAD_LEFT) : 'KH001';

        // Tạo Khóa học mới bao gồm mã được tạo tự động
        KhoaHoc::create(array_merge($request->all(), ['ma' => $newCode]));

        return redirect()->route('teacher.khoahoc')->with('success', 'Thêm khóa học thành công!');
    }

    // ✅ Hiển thị danh sách khóa học
    public function danhsachKhoaHoc()
    {
        $khoahocs = KhoaHoc::all();
        return view('teacher.khoahoc.danhsach', compact('khoahocs'));
    }

    // ✅ Hiển thị danh sách bài học thuộc 1 khóa học
    public function danhsachBaiHoc($idKhoaHoc)
    {
        $khoahoc = KhoaHoc::findOrFail($idKhoaHoc);
        $baihocs = BaiHoc::where('ma_khoa_hoc', $idKhoaHoc)->get();
        return view('teacher.baihoc.danhsach', compact('khoahoc', 'baihocs'));
    }

    // Thêm phương thức listStudents theo route đã khai báo
    public function listStudents(Request $request)
    {
        $search = $request->input('search');
        $students = Student::when($search, function ($query, $search) {
            return $query->where('ho_ten', 'LIKE', '%' . $search . '%');
        })
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('teacher.studentmanagement.list', compact('students'));
    }

    public function editStudent($id)
    {
        $student = \App\Models\Student::findOrFail($id);
        return view('teacher.studentmanagement.edit', compact('student'));
    }

    // Phương thức xóa học viên
    public function deleteStudent($id)
    {
        $student = \App\Models\Student::findOrFail($id);
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Xóa học viên thành công!');
    }
}

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
        return view('teacher.courses');
    }

    public function thongbao()
    {
        $thongBaoMoiNhat = ThongBao::orderBy('created_at', 'desc')->get();
        return view('teacher.thongbao', compact('thongBaoMoiNhat'));
    }

    public function classes()
    {
        return view('teacher.classes');
    }

    public function notifications()
    {
        return view('teacher.notifications');
    }

    public function profile()
    {
        return view('teacher.profile');
    }

    public function myCourses()
    {
        return view('teacher.mycourses');
    }

    public function khoahoc()
    {
        $khoahoctb = KhoaHoc::paginate(10);
        $tatcaGiangVien = KhoaHoc::select('giangvien')->distinct()->pluck('giangvien');
        return view('teacher.khoahoc.danhsach', compact('khoahoctb', 'tatcaGiangVien'));
    }

    public function createCourse()
    {
        return view('teacher.khoahoc.them');
    }

    public function storeCourse(Request $request)
    {
        // Xử lý thêm khóa học
        KhoaHoc::create($request->all());
        return redirect()->route('teacher.khoahoc.danhsach')->with('success', 'Thêm khóa học thành công!');
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
    public function listStudents()
    {
        $students = Student::all();
        return view('teacher.studentmanagement.list', compact('students'));
    }
}

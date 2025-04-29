<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KhoaHoc;
use App\Models\Student;
use App\Models\Diendan;
use App\Models\ThongBao;

class TeacherController extends Controller
{
    /**
     * Hiển thị trang chủ giảng viên
     */
    public function home()
    {
        $soKhoaHoc = KhoaHoc::count();
        $soDienDan = Diendan::count();
        $soHocVien = Student::count();
        $thongBaoMoiNhat = ThongBao::orderBy('created_at', 'desc')->take(5)->get();

        return view('teacher.home', compact('soKhoaHoc', 'soDienDan', 'soHocVien', 'thongBaoMoiNhat'));
    }

    // Các phương thức khác giữ nguyên
    public function courses()
    {
        return view('teacher.courses');
    }

    public function thongbao()
    {
        $thongBaoMoiNhat = \App\Models\ThongBao::orderBy('created_at', 'desc')->get();
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
        return view('teacher.khoahoc');
    }

    public function createCourse()
    {
        return view('teacher.themkhoahoc');
    }

    public function storeCourse(Request $request)
    {
        // Xử lý logic thêm khóa học ở đây
        return redirect()->route('teacher.khoahoc')->with('success', 'Thêm khóa học thành công!');
    }
}

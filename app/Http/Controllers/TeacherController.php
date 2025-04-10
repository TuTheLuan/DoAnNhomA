<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Hiển thị trang chủ giảng viên
     */
    public function home()
    {
        return view('teacher.home');
    }

    /**
     * Hiển thị danh sách khóa học
     */
    public function courses()
    {
        return view('teacher.courses');
    }

    /**
     * Hiển thị danh sách lớp học
     */
    public function classes()
    {
        return view('teacher.classes');
    }

    /**
     * Hiển thị thông báo
     */
    public function notifications()
    {
        return view('teacher.notifications');
    }

    /**
     * Hiển thị thông tin cá nhân
     */
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

    public function storeCourse(Request $request)
    {
        // Xử lý logic thêm khóa học ở đây
        return redirect()->route('teacher.khoahoc')->with('success', 'Thêm khóa học thành công!');
    }

    public function diendan(Request $request)
    {
        return view('teacher.diendan');
    }

    public function themdiendan(Request $request)
    {
        return view('teacher.themdiendan');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KhoaHoc;
use App\Models\BaiHoc;

class UserController extends Controller
{
    public function khoaHocCuaToi()
    {
        // Thay đổi lấy dữ liệu với phân trang
        $khoahocs = KhoaHoc::paginate(5);

        return view('user.khoahoc', compact('khoahocs'));
    }

    public function baihoc($khoahoc_id)
    {
        // Load khóa học kèm danh sách bài học và tài liệu liên quan
        $khoahoc = KhoaHoc::with(['baiHocs.taiLieu'])->findOrFail($khoahoc_id);

        // Lấy danh sách bài học đã load từ quan hệ
        $baihocs = $khoahoc->baiHocs;

        return view('user.baihoc', compact('khoahoc', 'baihocs'));
    }
}

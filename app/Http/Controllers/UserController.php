<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KhoaHoc; 

class UserController extends Controller
{
    public function khoaHocCuaToi()
    {
        // Tạm thời load tất cả khóa học để hiển thị
        $khoahocs = KhoaHoc::all(); 

        return view('user.khoahoc', compact('khoahocs'));
    }
}


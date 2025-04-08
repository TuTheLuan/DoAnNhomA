<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KhoaHocController extends Controller
{
    public function danhsach()
    {
        return view('khoahoc.danhsach');
    }
    public function themkhoahoc()
    {
        return view('khoahoc.themkhoahoc');
    }
}

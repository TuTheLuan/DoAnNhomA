<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaiHocController extends Controller
{
    public function danhsach()
    {
        return view('baihoc.danhsach');
    }
    // public function themkhoahoc()
    // {
    //     return view('khoahoc.themkhoahoc');
    // }
}

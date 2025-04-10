<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KhoaHoc; 

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
    public function index()
    {
        $khoahocs = KhoaHoc::all(); // Lấy tất cả khóa học từ database
        return view('khoahoc.danhsach', compact('khoahocs')); // Truyền biến sang view
    }

    public function store(Request $request)
    {
        $request->validate([
            'ten' => 'required|string|max:255',
            'giangvien' => 'required|string|max:255',
            'sobaihoc' => 'nullable|integer',
        ]);

        // Lấy mã khóa học cuối cùng
        $lastKhoaHoc = KhoaHoc::orderBy('id', 'desc')->first();

        if ($lastKhoaHoc && $lastKhoaHoc->ma) {
            $lastCode = (int)substr($lastKhoaHoc->ma, 2); // bỏ 'KH'
            $newCode = 'KH' . str_pad($lastCode + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $newCode = 'KH001';
        }

        // Tạo khóa học mới
        KhoaHoc::create([
            'ma' => $newCode, // ✅ đúng với tên cột trong DB
            'ten' => $request->ten,
            'giangvien' => $request->giangvien,
            'sobaihoc' => $request->sobaihoc,
        ]);

        return redirect()->route('khoahoc.index')->with('success', 'Thêm khóa học thành công!');
    }

    public function update(Request $request, $id)
    {
        $khoahoc = KhoaHoc::findOrFail($id);

        $khoahoc->update([
            'ten' => $request->ten,
            'giangvien' => $request->giangvien,
            'sobaihoc' => $request->sobaihoc,
        ]);

        return redirect()->route('khoahoc.index')->with('success', 'Cập nhật khóa học thành công!');
    }


    public function edit($id)
    {
        $khoahoctb = KhoaHoc::findOrFail($id);
        return view('khoahoc.edit', ['khoahoc' => $khoahoctb]);
    }

    public function destroy($id)
    {
        $khoahoc = KhoaHoc::findOrFail($id);
        $khoahoc->delete();

        return redirect()->route('khoahoc.index')->with('success', 'Đã xóa khóa học thành công.');
    }

}

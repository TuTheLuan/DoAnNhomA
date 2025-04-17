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
        $khoahoctb = KhoaHoc::all(); 
        return view('khoahoc.danhsach', compact('khoahoctb')); 
    }


    public function store(Request $request)
    {
        $request->validate([
            'ten' => 'required|string|max:255',
            'giangvien' => 'required|string|max:255',
            'sobaihoc' => 'nullable|integer',
            'anh' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // validate ảnh
        ]);

        // Xử lý mã KH
        $lastKhoaHoc = KhoaHoc::orderBy('id', 'desc')->first();
        $newCode = $lastKhoaHoc && $lastKhoaHoc->ma
            ? 'KH' . str_pad((int)substr($lastKhoaHoc->ma, 2) + 1, 3, '0', STR_PAD_LEFT)
            : 'KH001';

        // Xử lý ảnh
        $imageName = null;
        if ($request->hasFile('anh')) {
            $image = $request->file('anh');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
        }

        // Tạo khóa học
        KhoaHoc::create([
            'ma' => $newCode,
            'ten' => $request->ten,
            'giangvien' => $request->giangvien,
            'sobaihoc' => $request->sobaihoc,
            'anh' => $imageName, // lưu tên ảnh
        ]);

        return redirect()->route('khoahoc.index')->with('success', 'Thêm khóa học thành công!');
    }


    public function update(Request $request, $id)
    {
        $khoahoc = KhoaHoc::findOrFail($id);

        // Cập nhật thông tin cơ bản
        $khoahoc->ten = $request->ten;
        $khoahoc->giangvien = $request->giangvien;
        $khoahoc->sobaihoc = $request->sobaihoc;

        // Nếu có upload ảnh mới
        if ($request->hasFile('anh')) {
            $file = $request->file('anh');
            $filename = time() . '_' . $file->getClientOriginalName();

            // Di chuyển ảnh vào thư mục public/images
            $file->move(public_path('images'), $filename);

            // Cập nhật tên file ảnh vào DB
            $khoahoc->anh = $filename;
        }

        $khoahoc->save();

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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KhoaHoc;
use App\Models\BaiHoc;
use App\Models\TaiLieuBaiHoc;

class BaiHocController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'so' => 'required|integer',
            'tieude' => 'required|string|max:255',
            'khoahoc_id' => 'required|exists:khoahoctb,id',
            'files.*' => 'nullable|file|mimes:pdf,docx,ppt,txt|max:2048',
        ]);

        // Tạo bài học trước
        $baihoc = BaiHoc::create([
            'so' => $request->so,
            'tieude' => $request->tieude,
            'khoahoc_id' => $request->khoahoc_id,
        ]);

        // Nếu có file thì lưu
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('tailieu', 'public');
                TaiLieuBaiHoc::create([
                    'baihoc_id' => $baihoc->id,
                    'file' => $path,
                ]);
            }
        }

        return redirect()->route('baihoc.danhsach', $request->khoahoc_id)
                        ->with('success', 'Thêm bài học thành công!');
    }



    public function danhsach($id)
    {
        $khoahoc = KhoaHoc::findOrFail($id);
        $baihocs = BaiHoc::where('khoahoc_id', $id)->get();

        return view('baihoc.danhsach', compact('baihocs', 'khoahoc'));
    }



    public function thembaihoc($id)
    {
        $khoahoc = KhoaHoc::findOrFail($id);
        return view('baihoc.thembaihoc', compact('khoahoc'));
    }
    public function destroyAll($khoahoc_id)
    {
        // Lấy tất cả bài học thuộc khóa học
        $baihocs = BaiHoc::where('khoahoc_id', $khoahoc_id)->get();

        foreach ($baihocs as $baihoc) {
            // Xóa tài liệu liên quan nếu có
            TaiLieuBaiHoc::where('baihoc_id', $baihoc->id)->delete();
            $baihoc->delete();
        }

        return redirect()->route('baihoc.danhsach', $khoahoc_id)->with('success', 'Đã xóa tất cả bài học');
    }


}

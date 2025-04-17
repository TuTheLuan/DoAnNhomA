<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KhoaHoc;
use App\Models\BaiHoc;

class BaiHocController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'so' => 'required|integer',
            'tieude' => 'required|string|max:255',
            'khoahoc_id' => 'required|exists:khoahoctb,id', // kiểm tra ID khóa học có tồn tại
            'file' => 'nullable|file|mimes:pdf,docx,ppt,txt|max:2048',
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('baihoc_files', 'public');
        }

        BaiHoc::create([        
            'so' => $request->so,
            'tieude' => $request->tieude,
            'khoahoc_id' => $request->khoahoc_id, // thêm khóa học ID vào
            'file' => $filePath,
        ]);

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

}

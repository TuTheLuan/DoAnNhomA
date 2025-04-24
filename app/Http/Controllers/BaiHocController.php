<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
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
            'files' => 'nullable',
            'files.*' => 'nullable|file|mimes:pdf,docx,doc,ppt,pptx,txt|max:2048',
        ]);

        // Tạo bài học
        $baihoc = BaiHoc::create([
            'so' => $request->so,
            'tieude' => $request->tieude,
            'khoahoc_id' => $request->khoahoc_id,
        ]);

        // Lưu file nếu có
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $uploadedFile) {
                if ($uploadedFile->isValid()) {
                    $filename = time() . '_' . $uploadedFile->getClientOriginalName();
                    $path = $uploadedFile->storeAs('tailieu', $filename, 'public');

                    $fileModel = new TaiLieuBaiHoc();
                    $fileModel->baihoc_id = $baihoc->id;
                    $fileModel->file = $path;
                    $fileModel->original_name = $uploadedFile->getClientOriginalName(); // tên file gốc
                    $fileModel->save();
                }
            }
        }

        return redirect()
            ->route('baihoc.danhsach', $request->khoahoc_id)
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
    public function destroy($id)
    {
        $baihoc = BaiHoc::findOrFail($id);

        // Xóa tài liệu trước
        foreach ($baihoc->tailieu as $file) {
            Storage::disk('public')->delete($file->file);
            $file->delete();
        }

        // Xóa bài học
        $baihoc->delete();

        return back()->with('success', 'Đã xóa bài học thành công!');
    }

    public function edit($id)
    {
        $baihoc = BaiHoc::with('khoahoc')->findOrFail($id);
        return view('baihoc.edit', compact('baihoc'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'so' => 'required|integer',
            'tieude' => 'required|string|max:255',
            'files.*' => 'nullable|file|mimes:pdf,docx,doc,ppt,pptx,txt|max:2048',
        ]);

        $baihoc = BaiHoc::findOrFail($id);
        $baihoc->update([
            'so' => $request->so,
            'tieude' => $request->tieude,
        ]);

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $uploadedFile) {
                if ($uploadedFile->isValid()) {
                    $filename = time() . '_' . $uploadedFile->getClientOriginalName();
                    $path = $uploadedFile->storeAs('tailieu', $filename, 'public');

                    TaiLieuBaiHoc::create([
                        'baihoc_id' => $baihoc->id,
                        'file' => $path,
                        'original_name' => $uploadedFile->getClientOriginalName(),
                    ]);
                }
            }
        }

        return redirect()->route('baihoc.danhsach', $baihoc->khoahoc_id)->with('success', 'Cập nhật thành công!');
    }





}

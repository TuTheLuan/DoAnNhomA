<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Diendan;
use Illuminate\Support\Facades\DB;

class DiendanController extends Controller
{
    public function index()
    {
        $diendans = Diendan::all();
        return view('teacher.diendan', compact('diendans'));
    }

    public function create()
    {
        return view('teacher.themdiendan');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ten_dien_dan' => 'required|string|max:255',
            'loai_thao_luan' => 'required|in:public,anonymous',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            DB::beginTransaction();

            // Xử lý ảnh nền
            $backgroundImagePath = null;
            if ($request->hasFile('background_image')) {
                $backgroundImagePath = $request->file('background_image')->store('diendan_backgrounds', 'public');
            }

            // Xử lý nhiều ảnh đính kèm
            $imagePaths = [];
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $path = $image->store('diendan_images', 'public');
                    $imagePaths[] = $path;
                }
            }

            // Tạo mã diễn đàn tự động
            $lastDiendan = Diendan::orderBy('id', 'desc')->first();
            $newCode = $lastDiendan ? 'DD' . str_pad((int)substr($lastDiendan->ma_dien_dan, 2) + 1, 3, '0', STR_PAD_LEFT) : 'DD001';

            // Tạo diễn đàn mới
            Diendan::create([
                'ma_dien_dan' => $newCode,
                'ten_dien_dan' => $request->ten_dien_dan,
                'loai_thao_luan' => $request->loai_thao_luan,
                'background_image' => $backgroundImagePath,
                'images' => !empty($imagePaths) ? json_encode($imagePaths) : null,
                'ngay_tao' => now()
            ]);

            DB::commit();

            return redirect()->route('diendan.index')->with('success', 'Thêm diễn đàn thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $diendan = Diendan::findOrFail($id);
        return view('teacher.editdiendan', compact('diendan'));
    }

    public function update(Request $request, $id)
    {
        $diendan = Diendan::findOrFail($id);

        $diendan->update([
            'ten_dien_dan' => $request->ten_dien_dan,
            'loai_thao_luan' => $request->loai_thao_luan
        ]);

        return redirect()->route('diendan.index')->with('success', 'Cập nhật diễn đàn thành công!');
    }

    public function destroy($id)
    {
        $diendan = Diendan::findOrFail($id);
        $diendan->delete();

        return redirect()->route('diendan.index')->with('success', 'Xóa diễn đàn thành công!');
    }
}

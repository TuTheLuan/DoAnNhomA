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

    public function index(Request $request)
    {
        // Xử lý tìm kiếm
        $query = KhoaHoc::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('ten', 'like', "%$search%")
                ->orWhere('ma', 'like', "%$search%")
                ->orWhere('giangvien', 'like', "%$search%");
        }

        // Phân trang kèm theo search
        $khoahoctb = $query->paginate(5)->withQueryString();

        return view('khoahoc.danhsach', compact('khoahoctb'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'ten' => ['required', 'min:7', 'max:155', 'regex:/^[a-zA-ZÀ-ỹ0-9\s]+$/u'],
            'giangvien' => ['required', 'min:7', 'max:55', 'regex:/^[a-zA-ZÀ-ỹ0-9\s]+$/u'],
            'sobaihoc' => ['required', 'integer', 'min:1'],
            'anh' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ], [
            'ten.required' => 'Vui lòng nhập tên khóa học.',
            'ten.min' => 'Tên khóa học phải có ít nhất 7 ký tự.',
            'ten.max' => 'Tên khóa học không được vượt quá 155 ký tự.',
            'ten.regex' => 'Tên khóa học không được chứa ký tự đặc biệt.',
            
            'giangvien.required' => 'Vui lòng nhập tên giảng viên.',
            'giangvien.min' => 'Tên giảng viên phải có ít nhất 7 ký tự.',
            'giangvien.max' => 'Tên giảng viên không được vượt quá 55 ký tự.',
            'giangvien.regex' => 'Tên giảng viên không được chứa ký tự đặc biệt.',
            
            'sobaihoc.required' => 'Vui lòng nhập số bài học.',
            'sobaihoc.integer' => 'Số bài học phải là số nguyên.',
            'sobaihoc.min' => 'Số bài học phải lớn hơn 0.',
            
            'anh.image' => 'Tệp tải lên phải là ảnh.',
            'anh.mimes' => 'Ảnh phải có định dạng: jpeg, png, jpg, gif.',
            'anh.max' => 'Ảnh không được vượt quá 2MB.',
        ]);

        $lastKhoaHoc = KhoaHoc::orderBy('id', 'desc')->first();
        $newCode = $lastKhoaHoc && $lastKhoaHoc->ma
            ? 'KH' . str_pad((int)substr($lastKhoaHoc->ma, 2) + 1, 3, '0', STR_PAD_LEFT)
            : 'KH001';

        $imageName = null;
        if ($request->hasFile('anh')) {
            $image = $request->file('anh');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
        }

        KhoaHoc::create([
            'ma' => $newCode,
            'ten' => $request->ten,
            'giangvien' => $request->giangvien,
            'sobaihoc' => $request->sobaihoc,
            'anh' => $imageName,
        ]);

        return redirect()->route('khoahoc.index')->with('success', 'Thêm khóa học thành công!');
    }


    public function edit($id)
    {
        $khoahoctb = KhoaHoc::findOrFail($id);
        return view('khoahoc.edit', ['khoahoc' => $khoahoctb]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'ten' => ['required', 'min:7', 'max:155', 'regex:/^[a-zA-ZÀ-ỹ0-9\s]+$/u'],
            'giangvien' => ['required', 'min:7', 'max:55', 'regex:/^[a-zA-ZÀ-ỹ0-9\s]+$/u'],
            'sobaihoc' => ['required', 'integer', 'min:1'],
            'anh' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        $khoaHoc = KhoaHoc::findOrFail($id);

        // Cập nhật ảnh nếu có
        if ($request->hasFile('anh')) {
            $image = $request->file('anh');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $khoaHoc->anh = $imageName;
        }

        $khoaHoc->ten = $request->ten;
        $khoaHoc->giangvien = $request->giangvien;
        $khoaHoc->sobaihoc = $request->sobaihoc;

        $khoaHoc->save();

        return redirect()->route('khoahoc.index')->with('success', 'Cập nhật khóa học thành công!');
    }


    public function destroy($id)
    {
        $khoahoc = KhoaHoc::findOrFail($id);
        $khoahoc->delete();

        return redirect()->route('khoahoc.index')->with('success', 'Đã xóa khóa học thành công.');
    }
}

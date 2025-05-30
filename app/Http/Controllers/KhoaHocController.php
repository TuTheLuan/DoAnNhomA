<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KhoaHoc;

class KhoaHocController extends Controller
{
    public function danhsach()
    {
        $khoahoctb = KhoaHoc::paginate(10);
        return view('khoahoc.danhsach', compact('khoahoctb'));
    }

    public function themkhoahoc()
    {
        return view('teacher.khoahoc.themkhoahoc');
    }
    public function index(Request $request)
    {
        $query = KhoaHoc::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('ten', 'like', "%$search%")
                  ->orWhere('ma', 'like', "%$search%")
                  ->orWhere('giangvien', 'like', "%$search%");
            });
        }

        if ($request->filled('giangvien')) {
            $query->where('giangvien', $request->giangvien);
        }

        $khoahoctb = $query->paginate(5)->withQueryString();

        $tatcaGiangVien = KhoaHoc::select('giangvien')->distinct()->pluck('giangvien');

        return view('teacher.khoahoc.danhsach', compact('khoahoctb', 'tatcaGiangVien'));
    }

    public function create()
    {
        $trangThaiOptions = ['Mở', 'Đang diễn ra', 'Kết thúc', 'Ẩn'];
        return view('khoahoc.themkhoahoc', compact('trangThaiOptions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ten' => ['required', 'min:7', 'max:155', 'regex:/^[a-zA-ZÀ-ỹ0-9\s]+$/u'],
            'giangvien' => ['required', 'min:7', 'max:55', 'regex:/^[a-zA-ZÀ-ỹ0-9\s]+$/u'],
            'sobaihoc' => ['required', 'integer', 'min:1'],
            'anh' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'meet_link' => ['nullable', 'url'],
            'meet_time' => ['nullable', 'string', 'max:255'],
            'trangthai' => ['nullable', 'in:Mở,Đang diễn ra,Kết thúc,Ẩn'],
            'thoigian_batdau' => ['nullable', 'date'],
            'thoigian_ketthuc' => ['nullable', 'date', 'after_or_equal:thoigian_batdau'],
        ]);

        $last = KhoaHoc::orderBy('id', 'desc')->first();
        $newCode = $last && $last->ma
            ? 'KH' . str_pad((int)substr($last->ma, 2) + 1, 3, '0', STR_PAD_LEFT)
            : 'KH001';

        $imageName = null;
        if ($request->hasFile('anh')) {
            $image = $request->file('anh');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
        }

        $validTrangThai = ['Mở', 'Đang diễn ra', 'Kết thúc', 'Ẩn'];
        $trangthai = $request->input('trangthai');
        if (!in_array($trangthai, $validTrangThai)) {
            $trangthai = 'Mở';
        }

        KhoaHoc::create([
            'ma' => $newCode,
            'ten' => $request->ten,
            'giangvien' => $request->giangvien,
            'sobaihoc' => $request->sobaihoc,
            'anh' => $imageName,
            'meet_link' => $request->meet_link,
            'meet_time' => $request->meet_time,
            'trangthai' => $trangthai,
            'thoigian_batdau' => $request->thoigian_batdau,
            'thoigian_ketthuc' => $request->thoigian_ketthuc,
        ]);

        return redirect()->route('teacher.khoahoc.index')->with('success', 'Thêm khóa học thành công!');
    }

    public function edit($id)
    {
        $khoahoc = KhoaHoc::findOrFail($id);
        $trangThaiOptions = ['Mở', 'Đang diễn ra', 'Kết thúc', 'Ẩn'];
        return view('teacher.khoahoc.edit', compact('khoahoc', 'trangThaiOptions'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'ten' => ['required', 'min:7', 'max:155', 'regex:/^[a-zA-ZÀ-ỹ0-9\s]+$/u'],
            'giangvien' => ['required', 'min:7', 'max:55', 'regex:/^[a-zA-ZÀ-ỹ0-9\s]+$/u'],
            'sobaihoc' => ['required', 'integer', 'min:1'],
            'anh' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'meet_link' => ['nullable', 'url'],
            'meet_time' => ['nullable', 'string', 'max:255'],
            'trangthai' => ['nullable', 'in:Mở,Đang diễn ra,Kết thúc,Ẩn'],
            'thoigian_batdau' => ['nullable', 'date'],
            'thoigian_ketthuc' => ['nullable', 'date', 'after_or_equal:thoigian_batdau'],
        ]);

        $khoaHoc = KhoaHoc::findOrFail($id);

        if ($request->hasFile('anh')) {
            $image = $request->file('anh');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $khoaHoc->anh = $imageName;
        }

        $validTrangThai = ['Mở', 'Đang diễn ra', 'Kết thúc', 'Ẩn'];
        $trangthai = $request->input('trangthai');
        if (!in_array($trangthai, $validTrangThai)) {
            $trangthai = 'Mở';
        }

        $khoaHoc->ten = $request->ten;
        $khoaHoc->giangvien = $request->giangvien;
        $khoaHoc->sobaihoc = $request->sobaihoc;
        $khoaHoc->meet_link = $request->meet_link;
        $khoaHoc->meet_time = $request->meet_time;
        $khoaHoc->trangthai = $trangthai;
        $khoaHoc->thoigian_batdau = $request->thoigian_batdau;
        $khoaHoc->thoigian_ketthuc = $request->thoigian_ketthuc;

        $khoaHoc->save();

        return redirect()->route('teacher.khoahoc')->with('success', 'Cập nhật khóa học thành công!');
    }

    public function destroy($id)
    {
        $khoahoc = KhoaHoc::findOrFail($id);
        $khoahoc->delete();

        return redirect()->route('teacher.khoahoc.index')->with('success', 'Đã xóa khóa học thành công.');
    }
}

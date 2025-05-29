<?php

namespace App\Http\Controllers;
use App\Models\Student;
use App\Models\KhoaHoc;
use App\Models\Diendan;
use App\Models\ThongBao;
use Illuminate\Http\Request;
use App\Models\BaiHoc;
use App\Models\BaiThiHoanThanh;
use App\Models\DiemThi;




class StudentController extends Controller
{

    public function thongke(Request $request)
    {
        $tongHocVien = Student::count();
        $tongKhoaHoc = KhoaHoc::count();
        $tongBaiThiHoanThanh = DiemThi::count();
        $khoahoc = KhoaHoc::all();
        // Lấy biến tìm kiếm từ request
        $search = $request->input('search');
        $khoaHocId = $request->input('khoa_hoc');

        // Query builder bắt đầu từ model Student
        $query = Student::with(['diemBaiTap', 'diemThi']);

        // Nếu có tìm kiếm theo tên học viên
        if ($search) {
            $query->where('ho_ten', 'like', "{$search}%");
        }


        // Nếu có chọn khóa học (giả sử Student có khóa học liên kết)
        if ($khoaHocId) {
            $query->whereHas('khoaHocs', function ($q) use ($khoaHocId) {
                $q->where('khoahoc_id', $khoaHocId);
            });
        }

        // Phân trang
        $students = $query->paginate(10)->withQueryString();

        $bangDiem = $students->getCollection()->map(function ($student) {
            $diemBaiTap = [];
            foreach ($student->diemBaiTap as $baiTap) {
                $diemBaiTap[$baiTap->bai_so] = $baiTap->diem;
            }
            return [
                'ma_hoc_vien' => $student->id,
                'ten' => $student->ho_ten,
                'diem_bai_tap' => $diemBaiTap,
                'diem_thi' => optional($student->diemThi)->diem,
            ];
        });

        return view('teacher.thongke', [
            'tongHocVien' => $tongHocVien,
            'tongKhoaHoc' => $tongKhoaHoc,
            'tongBaiThiHoanThanh' => $tongBaiThiHoanThanh,
            'bangDiem' => $bangDiem,
            'students' => $students,
            'khoahoc' => $khoahoc, // Truyền danh sách khóa học
        ]);
    }


    // Hiển thị form thêm học viên
    public function create()
    {
        return view('teacher.studentmanagement.createhocvien');
    }

    public function store(Request $request)
    {
        $request->validate([

            'ho_ten' => ['required', 'string', 'max:100', 'regex:/^[\pL\s]+$/u'],
            'gioi_tinh' => 'required',
            'email' => 'required|email|unique:students,email',
            'dia_chi' => ['required', 'string', 'max:100', 'regex:/^[\pL\s]+$/u'],

        ]);

        Student::create([

            'ho_ten' => $request->ho_ten,
            'gioi_tinh' => $request->gioi_tinh,
            'email' => $request->email,
            'dia_chi' => $request->dia_chi,

        ]);

        return redirect()->route('students.index')->with('success', 'Thêm học viên thành công!');
    }

    // Hiển thị form sửa
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('teacher.studentmanagement.edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([

            'ho_ten' => ['required', 'string', 'max:100', 'regex:/^[\pL\s]+$/u'],
            'gioi_tinh' => 'required',
            'email' => 'required|email|unique:students,email,' . $id,
            'dia_chi' => ['required', 'string', 'max:100', 'regex:/^[\pL\s]+$/u'],

        ]);

        $student = Student::findOrFail($id);
        $student->update([

            'ho_ten' => $request->ho_ten,
            'gioi_tinh' => $request->gioi_tinh,
            'email' => $request->email,
            'dia_chi' => $request->dia_chi,

        ]);

        return redirect()->route('students.index')->with('success', 'Cập nhật học viên thành công!');
    }

    // Phương thức xóa học viên
    public function destroy($id)
    {
        Student::destroy($id);
        return redirect()->route('students.index');
    }

    public function index(Request $request)
    {
        $search = $request->input('search');

        $students = Student::when($search, function ($query, $search) {
            return $query->where('ho_ten', 'LIKE', '%' . $search . '%');
        })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('teacher.studentmanagement.list', compact('students'));
    }

    public function home()
    {
        $soKhoaHoc = KhoaHoc::count();
        $soDienDan = Diendan::count();
        $soHocVien = Student::count();
        $thongBaoMoiNhat = ThongBao::orderBy('created_at', 'desc')->take(5)->get();

        return view('students.home', compact('soKhoaHoc', 'soDienDan', 'soHocVien', 'thongBaoMoiNhat'));
    }

    public function thongbao()
    {
        $thongBaoMoiNhat = \App\Models\ThongBao::orderBy('created_at', 'desc')->get();
        return view('teacher.thongbao', compact('thongBaoMoiNhat'));
    }

    public function khoahoc(Request $request)
    {
        $query = \App\Models\KhoaHoc::query();

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

        $tatcaGiangVien = \App\Models\KhoaHoc::select('giangvien')->distinct()->pluck('giangvien');

        return view('students.khoahoc', compact('khoahoctb', 'tatcaGiangVien'));
    }

    // Thêm phương thức baihoc để xử lý route students.baihoc
    public function baihoc($id)
    {
        $khoahoc = \App\Models\KhoaHoc::with(['baiHocs.taiLieu'])->findOrFail($id);
        $baihocs = $khoahoc->baiHocs;

        return view('students.baihoc', compact('khoahoc', 'baihocs'));
    }

}

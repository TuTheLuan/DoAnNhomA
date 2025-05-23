<?php

namespace App\Http\Controllers;
use App\Models\Student; 
use App\Models\KhoaHoc;
use App\Models\Diendan;
use App\Models\ThongBao;
use Illuminate\Http\Request;

class StudentController extends Controller
{
     // Hiển thị form thêm học viên
     public function create()
     {
         return view('students.createhocvien'); // Phải trùng với tên file blade
     }
     
     public function store(Request $request)
     {
         $request->validate([
            
             'ho_ten' => 'required',
             'gioi_tinh' => 'required',
             'email' => 'required|email|unique:students,email',
             'dia_chi' => 'required',
           
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
         return view('students.edit', compact('student'));
     }
     
     public function update(Request $request, $id)
     {
         $request->validate([
         
             'ho_ten' => 'required',
             'gioi_tinh' => 'required',
             'email' => 'required|email|unique:students,email,' . $id,
             'dia_chi' => 'required',
             
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

        return view('students.list', compact('students'));
    }

    public function home()
    {
        $soKhoaHoc = KhoaHoc::count();
        $soDienDan = Diendan::count();
        $soHocVien = Student::count();
        $thongBaoMoiNhat = ThongBao::orderBy('created_at', 'desc')->take(5)->get();

        return view('students.home', compact('soKhoaHoc', 'soDienDan', 'soHocVien', 'thongBaoMoiNhat'));
    }

    public function khoahoc()
    {
        return view('students.khoahoc');
    }

    public function myCourses()
    {
        return view('students.khoahoccuatoi');
    }

    public function thongbao()
    {
        $thongBaoMoiNhat = \App\Models\ThongBao::orderBy('created_at', 'desc')->get();
        return view('students.thongbao', compact('thongBaoMoiNhat'));
    }
}

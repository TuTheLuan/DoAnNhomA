<?php

namespace App\Http\Controllers;
use App\Models\Student; 
use Illuminate\Http\Request;

class StudentController extends Controller
{
     // Hiển thị form thêm học viên
     public function create()
     {
         return view('students.create');
     }
 
     // Xử lý thêm học viên
     public function store(Request $request)
     {
         $request->validate([
             'ma_sv' => 'required|unique:students,ma_sv',
             'ho_ten' => 'required',
             'gioi_tinh' => 'required',
             'email' => 'required|email|unique:students,email',
             'dia_chi' => 'required',
             'trang_thai' => 'required',
         ]);
 
         Student::create($request->all());
 
         return redirect()->route('students.index')->with('success', 'Thêm học viên thành công!');
     }

     public function listHocVien()
     {
         // Lấy danh sách học viên từ cơ sở dữ liệu
         $students = Student::paginate(10);
         return view('students.list', compact('students'));
     }
     



}

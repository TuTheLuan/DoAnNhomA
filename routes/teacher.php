<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\KhoaHocController;
use App\Http\Controllers\BaiHocController;

// Trang giảng viên
Route::get('/teacher/home', [TeacherController::class, 'home'])->name('teacher.home');

// Khóa học
Route::get('/teacher/khoahoc', [TeacherController::class, 'khoahoc'])->name('teacher.khoahoc');
Route::get('/teacher/themkhoahoc', [TeacherController::class, 'createCourse'])->name('teacher.khoahoc.themkhoahoc');
Route::post('/teacher/luukhoahoc', [TeacherController::class, 'storeCourse'])->name('teacher.khoahoc.luukhoahoc');

Route::get('/teacher/khoahoc/{id}/edit', [KhoaHocController::class, 'edit'])->name('khoahoc.edit');
Route::put('/teacher/khoahoc/{id}', [KhoaHocController::class, 'update'])->name('khoahoc.update');
Route::delete('/teacher/khoahoc/{id}', [KhoaHocController::class, 'destroy'])->name('khoahoc.destroy');

// Quản lý học viên
Route::get('/teacher/studentmanagement', [TeacherController::class, 'listStudents'])->name('students.index');
Route::get('/teacher/studentmanagement/create', [App\Http\Controllers\StudentController::class, 'create'])->name('teacher.student.create');
Route::post('/teacher/studentmanagement', [App\Http\Controllers\StudentController::class, 'store'])->name('teacher.student.store');
Route::get('/teacher/studentmanagement/{id}/edit', [TeacherController::class, 'editStudent'])->name('teacher.student.edit');
Route::put('/teacher/studentmanagement/{id}', [TeacherController::class, 'updateStudent'])->name('teacher.student.update');
Route::delete('/teacher/studentmanagement/{id}', [TeacherController::class, 'deleteStudent'])->name('teacher.student.delete');

// Thống kê
Route::get('/teacher/thongke', [App\Http\Controllers\StudentController::class, 'thongke'])->name('teacher.thongke');

// Bài học
Route::get('/teacher/baihoc', [BaiHocController::class, 'danhsach'])->name('baihoc.danhsach');
Route::get('/teacher/baihoc/create', [BaiHocController::class, 'thembaihoc'])->name('baihoc.thembaihoc');
Route::post('/lessons', [BaiHocController::class, 'store'])->name('lessons.store');
Route::get('/teacher/baihoc/{id}/edit', [BaiHocController::class, 'edit'])->name('baihoc.edit');
Route::put('/teacher/baihoc/{id}', [BaiHocController::class, 'update'])->name('baihoc.update');
Route::delete('/teacher/baihoc/{id}', [BaiHocController::class, 'destroy'])->name('baihoc.destroy');

// Tài liệu bài học
Route::delete('/tailieu/{id}', [App\Http\Controllers\TaiLieuBaiHocController::class, 'destroy'])->name('tailieu.destroy');

// Điểm
Route::get('/teacher/khoahoc/{khoahocId}/diem', [App\Http\Controllers\DiemController::class, 'xemDiem'])->name('diem.xem');
Route::get('/teacher/khoahoc/{khoahocId}/diem/export', [App\Http\Controllers\DiemController::class, 'xuatExcel'])->name('diem.xuat');

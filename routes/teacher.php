<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\KhoaHocController;
use App\Http\Controllers\BaiHocController;

// Trang giảng viên
Route::get('/teacher/home', [TeacherController::class, 'home'])->name('teacher.home');

// Khóa học
Route::get('/teacher/khoahoc', [TeacherController::class, 'khoahoc'])->name('teacher.khoahoc');
Route::get('/teacher/themkhoahoc', [TeacherController::class, 'createCourse'])->name('teacher.themkhoahoc');
Route::post('/teacher/luukhoahoc', [TeacherController::class, 'storeCourse'])->name('teacher.luukhoahoc');

// Quản lý học viên
Route::get('/teacher/studentmanagement', [TeacherController::class, 'listStudents'])->name('teacher.student.list');
Route::get('/teacher/studentmanagement/create', [TeacherController::class, 'createStudent'])->name('teacher.student.create');
Route::post('/teacher/studentmanagement', [TeacherController::class, 'storeStudent'])->name('teacher.student.store');
Route::get('/teacher/studentmanagement/{id}/edit', [TeacherController::class, 'editStudent'])->name('teacher.student.edit');
Route::put('/teacher/studentmanagement/{id}', [TeacherController::class, 'updateStudent'])->name('teacher.student.update');
Route::delete('/teacher/studentmanagement/{id}', [TeacherController::class, 'deleteStudent'])->name('teacher.student.delete');

// Thống kê
Route::get('/teacher/thongke', [TeacherController::class, 'thongke'])->name('teacher.thongke');

// Bài học
Route::get('/teacher/baihoc', [BaiHocController::class, 'danhsach'])->name('baihoc.danhsach');
Route::get('/teacher/baihoc/create', [BaiHocController::class, 'thembaihoc'])->name('baihoc.thembaihoc');
Route::post('/lessons', [BaiHocController::class, 'store'])->name('lessons.store');

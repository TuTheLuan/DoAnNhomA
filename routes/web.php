<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\KhoaHocController;
use App\Http\Controllers\BaiHocController;
use App\Http\Controllers\TaiLieuBaiHocController;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
Route::post('/students', [StudentController::class, 'store'])->name('students.store');

Route::get('/students', [StudentController::class, 'index'])->name('students.index');

Route::get('/students/{id}/edit', [StudentController::class, 'edit'])->name('students.edit');
Route::put('/students/{id}', [StudentController::class, 'update'])->name('students.update');

Route::delete('/students/{student}', [StudentController::class, 'destroy'])->name('students.destroy');

Route::get('/students/home', [StudentController::class, 'home'])->name('students.home');

Route::get('/students/khoahoc', [StudentController::class, 'khoahoc'])->name('students.khoahoc');

Route::get('/students/khoahoccuatoi', [StudentController::class, 'khoahoccuatoi'])->name('students.khoahoccuatoi');

// Giảng viên
Route::get('/teacher/home', [TeacherController::class, 'home'])->name('teacher.home');
Route::get('/teacher/khoahoc', [TeacherController::class, 'khoahoc'])->name('teacher.khoahoc');
Route::get('/teacher/themkhoahoc', [TeacherController::class, 'createCourse'])->name('teacher.themkhoahoc');
Route::post('/teacher/luukhoahoc', [TeacherController::class, 'storeCourse'])->name('teacher.luukhoahoc');

//Khóa học
Route::get('/khoahoc/danhsach', [KhoaHocController::class, 'danhsach'])->name('khoahoc.danhsach');
Route::get('/khoahoc/themkhoahoc', [KhoaHocController::class, 'themkhoahoc'])->name('khoahoc.themkhoahoc');
Route::get('/khoahoc/danhsach', [KhoaHocController::class, 'index'])->name('khoahoc.index');

Route::get('khoahoc/{id}/edit', [KhoaHocController::class, 'edit'])->name('khoahoc.edit');
Route::delete('khoahoc/{id}', [KhoaHocController::class, 'destroy'])->name('khoahoc.destroy');

Route::post('/khoahoc', [KhoaHocController::class, 'store'])->name('khoahoc.store');

Route::put('khoahoc/{id}', [KhoaHocController::class, 'update'])->name('khoahoc.update');

//Bài học
// Danh sách bài học theo khóa học
Route::get('/baihoc/danhsach/{id}', [BaiHocController::class, 'danhsach'])->name('baihoc.danhsach');

// Form thêm bài học cho khóa học có ID
Route::get('/baihoc/them/{id}', [BaiHocController::class, 'thembaihoc'])->name('baihoc.thembaihoc');

// Lưu bài học vào DB (sau khi submit form)
Route::post('/baihoc/store', [BaiHocController::class, 'store'])->name('baihoc.store');

Route::delete('/baihoc/xoa/{id}', [BaiHocController::class, 'destroy'])->name('baihoc.destroy');

//Tài liệu
Route::delete('/tailieu/{id}', [TaiLieuBaiHocController::class, 'destroy'])->name('tailieu.destroy');
//Chỉnh sửa bài học 
Route::get('/baihoc/chinhsua/{id}', [BaiHocController::class, 'edit'])->name('baihoc.edit');
// Đổi từ /baihoc/capnhat/{id} -> /baihoc/update/{id}
Route::put('/baihoc/update/{id}', [BaiHocController::class, 'update'])->name('baihoc.update');

//Hiển thị khóa học user
Route::get('/user/khoahoc', [UserController::class, 'khoaHocCuaToi']);









Route::get('/', function () {
    return view('welcome');
});








<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\KhoaHocController;
use App\Http\Controllers\BaiHocController;
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

Route::get('/students/diendan', [StudentController::class, 'diendan'])->name('students.diendan');

// Giảng viên
Route::get('/teacher/home', [TeacherController::class, 'home'])->name('teacher.home');
Route::get('/teacher/khoahoc', [TeacherController::class, 'khoahoc'])->name('teacher.khoahoc');
Route::post('/teacher/luukhoahoc', [TeacherController::class, 'storeCourse'])->name('teacher.luukhoahoc');
Route::get('/teacher/diendan', [TeacherController::class, 'diendan'])->name('teacher.diendan');
Route::get('/teacher/themdiendan', [TeacherController::class, 'themdiendan'])->name('teacher.themdiendan');

//Khóa học
Route::get('/khoahoc/danhsach', [KhoaHocController::class, 'danhsach'])->name('khoahoc.danhsach');
Route::get('/khoahoc/themkhoahoc', [KhoaHocController::class, 'themkhoahoc'])->name('khoahoc.themkhoahoc');

//Bài học
Route::get('/baihoc/danhsach', [BaiHocController::class, 'danhsach'])->name('baihoc.danhsach');
Route::get('/', function () {
    return view('welcome');
});








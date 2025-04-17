<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\KhoaHocController;
use App\Http\Controllers\BaiHocController;
use App\Http\Controllers\DiendanController;
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

//Diễn đàn
Route::get('teacher/diendan', [DiendanController::class, 'index'])->name('diendan.index');

Route::get('students/diendan/{id}', [DiendanController::class, 'show'])->name('diendan.show');
Route::get('students/diendan', [DiendanController::class, 'indexForStudents'])->name('diendan.index.students');

Route::get('teacher/themdiendan', [DiendanController::class, 'create'])->name('diendan.create');
Route::post('teacher/themdiendan', [DiendanController::class, 'store'])->name('diendan.store');
Route::get('teacher/diendan/{id}/edit', [DiendanController::class, 'edit'])->name('diendan.edit');
Route::put('teacher/diendan/{id}', [DiendanController::class, 'update'])->name('diendan.update');
Route::delete('teacher/diendan/{id}', [DiendanController::class, 'destroy'])->name('diendan.destroy');

//Khóa học
Route::get('/khoahoc/danhsach', [KhoaHocController::class, 'danhsach'])->name('khoahoc.danhsach');
Route::get('/khoahoc/themkhoahoc', [KhoaHocController::class, 'themkhoahoc'])->name('khoahoc.themkhoahoc');
Route::get('/khoahoc/danhsach', [KhoaHocController::class, 'index'])->name('khoahoc.index');

Route::get('khoahoc/{id}/edit', [KhoaHocController::class, 'edit'])->name('khoahoc.edit');
Route::delete('khoahoc/{id}', [KhoaHocController::class, 'destroy'])->name('khoahoc.destroy');

Route::post('/khoahoc', [KhoaHocController::class, 'store'])->name('khoahoc.store');

Route::put('khoahoc/{id}', [KhoaHocController::class, 'update'])->name('khoahoc.update');

//Bài học
Route::get('/baihoc/danhsach', [BaiHocController::class, 'danhsach'])->name('baihoc.danhsach');
Route::get('/baihoc/thembaihoc', [BaiHocController::class, 'thembaihoc'])->name('baihoc.thembaihoc');
Route::get('/lessons', [LessonController::class, 'index'])->name('lessons.index');
Route::post('/lessons', [LessonController::class, 'store'])->name('lessons.store');






Route::get('/', function () {
    return view('welcome');
});








<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

// Trang học viên
Route::get('/students/home', [StudentController::class, 'home'])->name('students.home');
Route::get('/students/khoahoc', [StudentController::class, 'khoahoc'])->name('students.khoahoc');
Route::get('/students/khoahoccuatoi', [StudentController::class, 'khoahoccuatoi'])->name('students.khoahoccuatoi');
Route::get('/students/thongke', [StudentController::class, 'thongke'])->name('students.thongke');

Route::get('/students/baihoc/{id}', [StudentController::class, 'baihoc'])->name('students.baihoc');

Route::put('/students/{id}', [StudentController::class, 'update'])->name('students.update');

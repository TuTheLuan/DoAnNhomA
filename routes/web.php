<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\KhoaHocController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DiemController;
use App\Http\Controllers\TaiLieuBaiHocController;

use App\Http\Controllers\BaiHocController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\DiendanController;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

use App\Http\Middleware\RoleMiddleware;

// Phần routes cho Email Verification
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/login'); // Chuyển về trang login sau khi verify thành công
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/resend', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Link xác thực đã được gửi lại!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.resend');


// Học viên
Route::middleware([RoleMiddleware::class.':admin,teacher'])->group(function () {
    Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
    Route::post('/students', [StudentController::class, 'store'])->name('students.store');

    Route::get('/students', [StudentController::class, 'index'])->name('students.index');

    Route::get('/students/{id}/edit', [StudentController::class, 'edit'])->name('students.edit');
    Route::put('/students/{id}', [StudentController::class, 'update'])->name('students.update');

    Route::delete('/students/{student}', [StudentController::class, 'destroy'])->name('students.destroy');

    Route::get('/students/khoahoc', [StudentController::class, 'khoahoc'])->name('students.khoahoc');

    Route::get('/students/thongbao', [StudentController::class, 'thongbao'])->name('students.thongbao');

    Route::get('/students/thongke', [StudentController::class, 'thongke'])->name('students.thongke');
});

Route::middleware([RoleMiddleware::class.':admin,teacher,student'])->group(function () {
    Route::get('/students/home', [StudentController::class, 'home'])->name('students.home');
});

// Giảng viên
Route::middleware([RoleMiddleware::class.':admin,teacher'])->group(function () {
    Route::get('/teacher/home', [TeacherController::class, 'home'])->name('teacher.home');
    Route::get('/teacher/khoahoc', [TeacherController::class, 'khoahoc'])->name('teacher.khoahoc');
    Route::get('/teacher/themkhoahoc', [TeacherController::class, 'createCourse'])->name('teacher.themkhoahoc');
    Route::post('/teacher/luukhoahoc', [TeacherController::class, 'storeCourse'])->name('teacher.luukhoahoc');
    Route::get('/teacher/thongbao', [TeacherController::class, 'thongbao'])->name('teacher.thongbao');
});

// Diễn đàn
Route::middleware([RoleMiddleware::class.':admin,teacher'])->group(function () {
    Route::get('teacher/diendan', [DiendanController::class, 'index'])->name('diendan.index');

    Route::get('teacher/themdiendan', [DiendanController::class, 'create'])->name('diendan.create');
    Route::post('teacher/themdiendan', [DiendanController::class, 'store'])->name('diendan.store');
    Route::get('teacher/diendan/{id}/edit', [DiendanController::class, 'edit'])->name('diendan.edit');
    Route::put('teacher/diendan/{id}', [DiendanController::class, 'update'])->name('diendan.update');
    Route::delete('teacher/diendan/{id}', [DiendanController::class, 'destroy'])->name('diendan.destroy');
});

Route::middleware([RoleMiddleware::class.':admin,teacher,student'])->group(function () {
    Route::get('students/diendan/{id}', [DiendanController::class, 'show'])->name('diendan.show');
    Route::get('students/diendan/{id}/chat', [DiendanController::class, 'chat'])->name('diendan.chat');
    Route::post('students/diendan/{id}/chat/send', [DiendanController::class, 'chatSend'])->name('diendan.chat.send');
    Route::get('students/diendan', [DiendanController::class, 'indexForStudents'])->name('diendan.index.students');
});

// Khóa học
Route::get('/khoahoc/danhsach', [KhoaHocController::class, 'danhsach'])->name('khoahoc.danhsach');
Route::get('/khoahoc/themkhoahoc', [KhoaHocController::class, 'themkhoahoc'])->name('khoahoc.themkhoahoc');
Route::get('/khoahoc/danhsach', [KhoaHocController::class, 'index'])->name('khoahoc.index');

Route::get('khoahoc/{id}/edit', [KhoaHocController::class, 'edit'])->name('khoahoc.edit');
Route::delete('khoahoc/{id}', [KhoaHocController::class, 'destroy'])->name('khoahoc.destroy');

Route::post('/khoahoc', [KhoaHocController::class, 'store'])->name('khoahoc.store');

Route::put('khoahoc/{id}', [KhoaHocController::class, 'update'])->name('khoahoc.update');

// Bài học
Route::get('/baihoc/danhsach/{id}', [BaiHocController::class, 'danhsach'])->name('baihoc.danhsach');

Route::get('/baihoc/them/{id}', [BaiHocController::class, 'thembaihoc'])->name('baihoc.thembaihoc');

Route::post('/baihoc/store', [BaiHocController::class, 'store'])->name('baihoc.store');

Route::delete('/baihoc/xoa/{id}', [BaiHocController::class, 'destroy'])->name('baihoc.destroy');

Route::get('/baihoc/chinhsua/{id}', [BaiHocController::class, 'edit'])->name('baihoc.edit');

Route::put('/baihoc/update/{id}', [BaiHocController::class, 'update'])->name('baihoc.update');

// Tài liệu
Route::delete('/tailieu/{id}', [TaiLieuBaiHocController::class, 'destroy'])->name('tailieu.destroy');

// Hiển thị khóa học user
Route::get('/user/khoahoc', [UserController::class, 'khoaHocCuaToi'])->name('user.khoahoc');
Route::get('/user/baihoc/{khoahoc_id}', [UserController::class, 'baihoc'])->name('user.baihoc');

// Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Register
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Quên mật khẩu (custom flow)
Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetCode'])->name('password.email');

Route::get('/verify-token', [ForgotPasswordController::class, 'showVerifyForm'])->name('password.verify');
Route::post('/verify-token', [ForgotPasswordController::class, 'verifyToken']);

Route::get('/reset-password', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset.custom');
Route::post('/reset-password', [ForgotPasswordController::class, 'updatePassword'])->name('password.update.custom');

// Setting
Route::get('/settings', [SettingsController::class, 'edit'])->name('settings.edit');
Route::put('/settings', [SettingsController::class, 'update'])->name('settings.update');

// Trang welcome
Route::get('/', function () {
    return view('welcome');
});

// Điểm
Route::prefix('diem')->group(function () {
    Route::get('/xem/{id}', [DiemController::class, 'xemDiem'])->name('diem.xem');
    Route::get('/xuat-excel/{id}', [DiemController::class, 'xuatExcel'])->name('diem.xuat');
    Route::get('/thoat', [DiemController::class, 'thoat'])->name('diem.thoat');
});

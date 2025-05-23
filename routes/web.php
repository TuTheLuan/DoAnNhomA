<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;


Route::get('/', function () {
    return view('welcome');
});


// Xác thực (auth)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/password/reset', [ForgotPasswordController::class, 'showForgotForm'])->name('password.request');
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetCode'])->name('password.email');
Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::get('/password/verify', [ForgotPasswordController::class, 'showVerifyForm'])->name('password.verify');
Route::post('/password/verify', [ForgotPasswordController::class, 'verifyToken'])->name('password.verify');

Route::get('/password/reset/custom', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset.custom');
Route::post('/password/reset/custom', [ForgotPasswordController::class, 'updatePassword'])->name('password.update.custom');

require __DIR__.'/guest.php';
require __DIR__.'/student.php';
require __DIR__.'/teacher.php';
require __DIR__.'/user.php';



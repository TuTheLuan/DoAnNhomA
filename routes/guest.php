<?php

use Illuminate\Support\Facades\Route;

// Trang dành cho khách (chưa đăng nhập)
Route::get('/guest/home', function () {
    return view('guest.home');
})->name('guest.home');

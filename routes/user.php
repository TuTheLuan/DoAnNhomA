<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiendanController;
use App\Http\Controllers\SettingsController;

// Nhóm route Diễn đàn thống nhất cho cả user (teacher và student)
Route::prefix('diendan')->name('diendan.')->group(function () {
    // Tạo diễn đàn (chung, xử lý quyền trong controller)
    Route::get('/create', [DiendanController::class, 'create'])->name('create');
    Route::post('/', [DiendanController::class, 'store'])->name('store');

    // Danh sách diễn đàn (chung)
    Route::get('/', [DiendanController::class, 'index'])->name('index'); // Dùng index chung

    // Hiển thị chi tiết diễn đàn (chung)
    Route::get('/{id}', [DiendanController::class, 'show'])->name('show');

    // Sửa, xóa diễn đàn (chung, xử lý quyền trong controller)
    Route::get('/{id}/edit', [DiendanController::class, 'edit'])->name('edit');
    Route::put('/{id}', [DiendanController::class, 'update'])->name('update');
    Route::delete('/{id}', [DiendanController::class, 'destroy'])->name('destroy');

    // Chat trong diễn đàn (chung)
    Route::get('/{id}/chat', [DiendanController::class, 'chat'])->name('chat');
    Route::post('/{id}/chat', [DiendanController::class, 'chatSend'])->name('chat.store');
});

// Cài đặt
Route::get('/settings', [SettingsController::class, 'edit'])->name('settings.edit');
Route::put('/settings', [SettingsController::class, 'update'])->name('settings.update');
Route::delete('/settings', [SettingsController::class, 'deleteAccount'])->name('settings.delete');

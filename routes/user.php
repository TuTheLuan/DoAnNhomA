<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiendanController;
use App\Http\Controllers\SettingsController;

// Diễn đàn
Route::get('/students/diendan', [DiendanController::class, 'indexForStudents'])->name('diendan.index.students');
Route::get('/students/diendan/{id}', [DiendanController::class, 'show'])->name('diendan.show');

Route::get('/teacher/diendan', [DiendanController::class, 'index'])->name('diendan.index');
Route::get('/teacher/themdiendan', [DiendanController::class, 'create'])->name('diendan.create');
Route::post('/teacher/themdiendan', [DiendanController::class, 'store'])->name('diendan.store');
Route::get('/teacher/diendan/{id}/edit', [DiendanController::class, 'edit'])->name('diendan.edit');
Route::put('/teacher/diendan/{id}', [DiendanController::class, 'update'])->name('diendan.update');
Route::delete('/teacher/diendan/{id}', [DiendanController::class, 'destroy'])->name('diendan.destroy');

// Cài đặt
Route::get('/settings', [SettingsController::class, 'edit'])->name('settings.edit');
Route::put('/settings', [SettingsController::class, 'update'])->name('settings.update');

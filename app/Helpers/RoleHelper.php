<?php

use Illuminate\Support\Facades\Route;

if (!function_exists('canAccessCurrentRoute')) {
    function canAccessCurrentRoute()
    {
        $user = auth()->user();
        if (!$user) return false;

        $currentRouteName = Route::currentRouteName();

        // Nếu route có prefix 'user.' thì cả teacher và student đều được truy cập
        if (str_starts_with($currentRouteName, 'user.')) {
            return in_array($user->role, ['teacher', 'student']);
        }

        // Nếu route có prefix 'teacher.' thì chỉ teacher truy cập được
        if (str_starts_with($currentRouteName, 'teacher.')) {
            return $user->role === 'teacher';
        }

        // Nếu route có prefix 'student.' thì chỉ student truy cập được
        if (str_starts_with($currentRouteName, 'student.')) {
            return $user->role === 'student';
        }

        // Mặc định: cho phép truy cập
        return true;
    }
}

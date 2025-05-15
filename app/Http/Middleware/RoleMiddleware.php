<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        // Nếu chưa đăng nhập thì chuyển hướng về trang login
        if (!$user) {
            return redirect()->route('login');
        }

        // Kiểm tra nếu vai trò của user không nằm trong danh sách $roles thì abort 403
        if (!in_array($user->role, $roles)) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}

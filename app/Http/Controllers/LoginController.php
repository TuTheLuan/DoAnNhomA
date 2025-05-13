<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Đăng xuất thành công!');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
$request->validate([
    'username' => 'required|string|max:255',
    'password' => 'required|min:6|max:20',
], [
    'username.required' => 'Tên người dùng hoặc email không được để trống.',
    'username.max' => 'Tên người dùng hoặc email không được quá 255 ký tự.',
    'password.required' => 'Mật khẩu không được để trống.',
    'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
    'password.max' => 'Mật khẩu không được quá 20 ký tự.',
]);

        $field = filter_var($request->input('username'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $credentials = [$field => $request->input('username'), 'password' => $request->input('password')];

        Log::info('Đăng nhập với:', $credentials);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            Log::info('Đăng nhập thành công:', ['user' => $user->username, 'role' => $user->role]);

            $request->session()->regenerate();

            if ($user->role === 'student') {
                return redirect()->route('user.khoahoc'); // Chuyển hướng student đến user.khoahoc
            } elseif ($user->role === 'teacher') {
                return redirect()->route('teacher.home'); // Chuyển hướng teacher đến teacher.home
            } elseif ($user->role === 'admin') {
                return redirect()->route('students.home'); // Chuyển hướng admin đến students.home
            }

            return redirect()->route('dashboard'); // Default
        }

        Log::error('Đăng nhập thất bại:', $credentials);
        return back()->withErrors([
            'username' => 'Tên người dùng hoặc mật khẩu không đúng.',
        ])->onlyInput('username');
    }
    protected function username()
    {
        return 'username'; // Sử dụng cột username để xác thực
    }
}
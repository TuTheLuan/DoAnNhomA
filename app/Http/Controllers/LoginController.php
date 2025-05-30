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
            'password' => 'required|min:6',
        ], [
            'username.required' => 'Tên người dùng hoặc email không được để trống.',
            'username.max' => 'Tên người dùng hoặc email không được quá 255 ký tự.',
            'password.required' => 'Mật khẩu không được để trống.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
        ]);

        // Determine if the login attempt is using email or username
        $login = $request->input('username');
        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $fieldType => $login,
            'password' => $request->input('password')
        ];

        // Remove domain validation - you might want to add more sophisticated email validation if needed
        // if ($fieldType === 'email') {
        //     $validDomains = ['gmail.com', 'hotmail.com', 'yahoo.com', 'outlook.com', 'icloud.com', 'aol.com', 'protonmail.com', 'zoho.com', 'yandex.com'];
        //     $domain = substr(strrchr($login, "@"), 1);
        //     if (!in_array($domain, $validDomains)) {
        //         return back()->withErrors(['username' => 'Email không hợp lệ, vui lòng nhập lại email!'])->withInput();
        //     }
        // }

        Log::info('Đăng nhập với:', $credentials);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            Log::info('Đăng nhập thành công:', ['user' => $user->username, 'role' => $user->role]);

            $request->session()->regenerate();

            if ($user->role === 'student') {
                return redirect()->route('students.khoahoc'); // Chuyển hướng student đến students.khoahoc
            } elseif ($user->role === 'teacher') {
                return redirect()->route('teacher.home'); // Chuyển hướng teacher đến teacher.home
            } elseif ($user->role === 'admin') {
                return redirect()->route('students.home'); // Chuyển hướng admin đến students.home
            }

            return redirect()->intended('/dashboard'); // Redirect to intended URL or default dashboard
        }

        Log::error('Đăng nhập thất bại:', $credentials);
        return back()->withErrors([
            'username' => 'Thông tin đăng nhập không đúng.',
        ])->onlyInput('username');
    }
}
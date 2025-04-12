<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validation cơ bản
        $request->validate([
            'username' => 'required|min:1|max:10|regex:/^[a-zA-Z0-9]+$/',
            'password' => 'required|min:6|max:20',
        ], [
            'username.required' => 'Tên người dùng không được để trống.',
            'username.min' => 'Tên người dùng phải có ít nhất 1 ký tự.',
            'username.max' => 'Tên người dùng không được quá 10 ký tự.',
            'username.regex' => 'Tên người dùng không được chứa ký tự đặc biệt.',
            'password.required' => 'Mật khẩu không được để trống.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'password.max' => 'Mật khẩu không được quá 20 ký tự.',
        ]);

        // Lấy thông tin đăng nhập
        $credentials = $request->only('username', 'password');

        // Thử đăng nhập
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // Tái tạo session để tăng bảo mật
            return redirect()->intended('dashboard'); 
        }

        // Nếu đăng nhập thất bại, trả về lỗi
        return back()->withErrors([
            'username' => 'Tên người dùng hoặc mật khẩu không đúng.',
        ])->onlyInput('username');
    }

    protected function username()
    {
        return 'username'; // Sử dụng cột username để xác thực
    }
}
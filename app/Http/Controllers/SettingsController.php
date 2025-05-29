<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit()
    {
        $user = Auth::user();
        return view('user.settings', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $allowedDomains = [
            'gmail.com', 'hotmail.com', 'yahoo.com', 'outlook.com', 'live.com',
            'icloud.com', 'msn.com', 'aol.com', 'mail.com', 'zoho.com', 'protonmail.com',
        ];

        $emailDomain = substr(strrchr($request->email, "@"), 1);

        $request->validate([
            'username' => ['required', 'string', 'min:1', 'max:10', 'regex:/^[a-zA-Z0-9]+$/', 'unique:users,username,' . $user->id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            // Bỏ 'current_password' => ['required'], không kiểm tra mật khẩu hiện tại nữa
            'new_password' => ['nullable', 'string', 'min:6', 'max:20', 'confirmed', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/'],
        ], [
            'username.required' => 'Tên tài khoản không được để trống.',
            'username.min' => 'Tên tài khoản phải có ít nhất 1 ký tự.',
            'username.max' => 'Tên tài khoản không được quá 10 ký tự.',
            'username.regex' => 'Tên tài khoản không được chứa ký tự đặc biệt.',
            'username.unique' => 'Tên tài khoản đã tồn tại.',
            'email.required' => 'Email không được để trống.',
            'email.email' => 'Email không đúng định dạng.',
            'email.unique' => 'Email đã tồn tại.',
            // Bỏ message cho current_password
            'new_password.min' => 'Mật khẩu mới phải có ít nhất 6 ký tự.',
            'new_password.max' => 'Mật khẩu mới không được quá 20 ký tự.',
            'new_password.confirmed' => 'Xác nhận mật khẩu mới không khớp.',
            'new_password.regex' => 'Mật khẩu mới phải chứa ít nhất 1 chữ thường, 1 chữ in hoa, 1 số và 1 ký tự đặc biệt.',
        ]);

        if (!in_array(strtolower($emailDomain), $allowedDomains)) {
            return back()->withErrors(['email' => 'Email không hợp lệ, vui lòng nhập lại email!'])->withInput();
        }

        

        $user->username = $request->username;
        $user->email = $request->email;

        if ($request->filled('new_password')) {
            $user->password = Hash::make($request->new_password);
        }

        $user->save();

        return redirect()->route('settings.edit')->with('success', 'Cập nhật thành công!');
    }

    public function deleteAccount(Request $request)
    {
        $user = auth()->user();
        
        // Xóa tài khoản
        $user->delete();
        
        // Đăng xuất
        auth()->logout();
        
        // Xóa session
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        // Chuyển hướng đến trang login với thông báo
        return redirect()->route('login')->with('success', 'Tài khoản của bạn đã được xóa thành công.');
    }
}

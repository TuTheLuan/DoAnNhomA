<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    /**
     * Show the registration form.
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request.
     */
    public function register(Request $request)
    {
        $messages = [
            'username.required' => 'Tên người dùng không được để trống.',
            'username.min' => 'Tên người dùng phải có ít nhất 1 ký tự.',
            'username.max' => 'Tên người dùng không được quá 10 ký tự.',
            'username.regex' => 'Tên người dùng không được chứa ký tự đặc biệt.',
            'username.unique' => 'Tên người dùng đã tồn tại.',
            'email.required' => 'Email không được để trống.',
            'email.email' => 'Email không đúng định dạng.',
            'email.unique' => 'Email đã tồn tại.',
            'password.required' => 'Mật khẩu không được để trống.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'password.max' => 'Mật khẩu không được quá 20 ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
            'password.regex' => 'Mật khẩu phải chứa ít nhất 1 chữ thường, 1 chữ in hoa, 1 số và 1 ký tự đặc biệt.'
        ];

        $validator = Validator::make($request->all(), [
            'username' => ['required', 'string', 'min:1', 'max:10', 'regex:/^[a-zA-Z0-9]+$/', 'unique:users,username'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6', 'max:20', 'confirmed', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/'],
            'role' => ['required', 'string', 'in:student,teacher,admin'],
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Danh sách domain email cho phép
        $allowedDomains = [
            'gmail.com',
            'hotmail.com',
            'yahoo.com',
            'outlook.com',
            'live.com',
            'icloud.com', 
            'msn.com',
            'aol.com',
            'mail.com',
            'zoho.com',
            'protonmail.com',
        ];

        // Lấy domain từ email
        $emailDomain = substr(strrchr($request->email, "@"), 1);

        if (!in_array(strtolower($emailDomain), $allowedDomains)) {
            return redirect()->back()->withErrors(['email' => 'Email không hợp lệ, vui lòng nhập lại email!'])->withInput();
        }

        $status = 'approved';

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'status' => $status,
        ]);

        event(new Registered($user));

        // Sau khi đăng ký, chuyển về trang đăng nhập mà không tự động đăng nhập
        return redirect()->route('login')->with('message', 'Đăng ký thành công! Vui lòng đăng nhập để tiếp tục.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class ForgotPasswordController extends Controller
{

    public function showForgotForm() {
        return view('auth.forgot_password');
    }
    
    public function sendResetCode(Request $request) {
        $request->validate(['email' => 'required|email']);
        
        //  Kiểm tra domain email hợp lệ 
        $validDomains = ['gmail.com', 'hotmail.com', 'yahoo.com', 'outlook.com', 'icloud.com', 'aol.com', 'protonmail.com', 'zoho.com', 'yandex.com'];
        $domain = substr(strrchr($request->email, "@"), 1);

        if (!in_array($domain, $validDomains)) {
            return back()->withErrors(['email' => 'Email không hợp lệ, vui lòng nhập lại email!'])->withInput();
        }

        $user = User::where('email', $request->email)->first();
    
        if (!$user) {
            return back()->withErrors(['email' => 'Email không tồn tại']);
        }
    
        $token = rand(100000, 999999); // Mã 6 số
    
        // Gửi mail
        Mail::raw("Mã xác nhận của bạn là: $token", function($message) use ($user) {
            $message->to($user->email)
                    ->subject('Mã xác nhận đặt lại mật khẩu');
        });
    
        // Lưu token và email vào session (hoặc bảng trung gian)
        Session::put('reset_token', $token);
        Session::put('reset_email', $user->email);
    
        return redirect()->route('password.verify');
    }
    
    public function showVerifyForm() {
        return view('auth.verify_token');
    }
    
    public function verifyToken(Request $request) {
        $request->validate(['token' => 'required|numeric']);
    
        if ($request->token == Session::get('reset_token')) {
            return redirect()->route('password.reset.custom');
        }
    
        return back()->withErrors(['token' => 'Mã không đúng']);
    }
    
    public function showResetForm() {
        return view('auth.reset_custom');
    }
    
    public function updatePassword(Request $request) {
        $request->validate([
            'password' => 'required|min:6|confirmed'
        ]);
    
        $user = User::where('email', Session::get('reset_email'))->first();
    
        if ($user) {
            $user->password = Hash::make($request->password);
            $user->save();
    
            // Xóa session
            Session::forget(['reset_token', 'reset_email']);
    
            return redirect()->route('login')->with('status', 'Đặt lại mật khẩu thành công!');
        }
    
        return redirect()->route('password.request')->withErrors(['email' => 'Có lỗi xảy ra']);
    }
}
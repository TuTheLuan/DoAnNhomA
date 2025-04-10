<!-- resources/views/auth/register.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="text-center py-3 mb-4 bg-success text-white rounded">
                <h1>Đăng Ký</h1>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-3">
                    <label for="username" class="form-label">Tên đăng nhập</label>
                    <input type="text" name="username" id="username" class="form-control rounded-pill shadow-sm text-center" value="{{ old('username') }}" required>
                    @error('username')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control rounded-pill shadow-sm text-center" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Mật khẩu</label>
                    <div class="password-container">
                        <input type="password" name="password" id="password" class="form-control rounded-pill shadow-sm text-center" required>
                        <i class="fas fa-eye eye-icon"></i>
                    </div>
                    @error('password')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Xác nhận mật khẩu</label>
                    <div class="password-container">
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control rounded-pill shadow-sm text-center" required>
                        <i class="fas fa-eye eye-icon"></i>
                    </div>
                </div>

                <button type="submit" class="btn btn-success d-block mx-auto mt-3 rounded-pill">
                    Đăng Ký
                </button>
            </form>

            <div class="text-center mt-3">
                <p>Đã có tài khoản? <a href="{{ route('login') }}" class="text-primary text-decoration-none">Đăng nhập ngay</a></p>
            </div>
        </div>
    </div>
</div>
@endsection
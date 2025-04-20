@extends('layouts.auth')

@section('title', 'Đăng Nhập')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="text-center py-3 mb-4 bg-success text-white rounded">
                <h1>Đăng Nhập</h1>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label for="username" class="form-label">Tên người dùng</label>
                    <div class="input-group">
                        <input type="text" name="username" id="username" class="form-control rounded-start shadow-sm" value="{{ old('username') }}" required autocomplete="username" autofocus>
                    </div>
                    @error('username')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Mật khẩu</label>
                    <div class="input-group">
                        <input type="password" name="password" id="password" class="form-control rounded-start" required>
                        <span class="input-group-text bg-light eye-container">
                            <i class="fas fa-eye toggle-password" data-target="password"></i>
                        </span>
                    </div>
                    @error('password')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 text-start">
                    <a href="{{ route('password.request') }}" class="text-primary text-decoration-none">Bạn quên mật khẩu?</a>
                </div>

<button type="submit" class="btn btn-success d-block mx-auto mt-3 rounded-pill">
    <i class="fas fa-arrow-right"></i>
</button>

                <p class="mt-3 text-center">
                    <a href="{{ route('register') }}" class="text-primary text-decoration-none">Bạn chưa có tài khoản?</a>
                </p>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function showHint(element) {
        const hintId = element.id + '-hint';
        document.getElementById(hintId).classList.remove('d-none');
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Sự kiện hiển thị gợi ý khi focus vào input
        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('focus', function() {
                showHint(this);
            });
        });

        // Sự kiện hiển thị/ẩn mật khẩu
        document.querySelectorAll('.toggle-password').forEach(icon => {
            icon.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                const passwordField = document.getElementById(targetId);
                
                if (passwordField.type === 'password') {
                    passwordField.type = 'text';
                    this.classList.remove('fa-eye');
                    this.classList.add('fa-eye-slash');
                } else {
                    passwordField.type = 'password';
                    this.classList.remove('fa-eye-slash');
                    this.classList.add('fa-eye');
                }
            });
        });
    });
</script>
@endsection
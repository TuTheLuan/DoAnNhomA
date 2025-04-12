@extends('layouts.auth')

@section('title', 'Đăng Ký')

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
                    <input type="text" name="username" id="username" class="form-control rounded-pill shadow-sm" value="{{ old('username') }}" required>
                    @error('username')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control rounded-pill shadow-sm" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Mật khẩu</label>
                    <div class="password-container">
                        <input type="password" name="password" id="password" class="form-control rounded-pill shadow-sm" required>
                        <span class="eye-icon"><i class="fas fa-eye"></i></span>
                    </div>
                    @error('password')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Xác nhận mật khẩu</label>
                    <div class="password-container">
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control rounded-pill shadow-sm" required>
                        <span class="eye-icon"><i class="fas fa-eye"></i></span>
                    </div>
                </div>

                <button href="{{ route('login') }}" type="submit" class="btn btn-success d-block mx-auto mt-3 rounded-pill">
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

@section('scripts')
<script>
    function togglePassword(fieldId) {
        const field = document.getElementById(fieldId);
        const icon = field.nextElementSibling.querySelector('i');
        if (field.type === 'password') {
            field.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            field.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }

    document.querySelectorAll('.eye-icon').forEach(icon => {
        icon.addEventListener('click', function() {
            const fieldId = this.previousElementSibling.id;
            togglePassword(fieldId);
        });
    });
</script>
@endsection
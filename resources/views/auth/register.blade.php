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
                    <input type="text" name="username" id="username" class="form-control rounded-start shadow-sm" value="{{ old('username') }}" required>
                    @error('username')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control rounded-start shadow-sm" value="{{ old('email') }}" required>
                    @error('email')
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

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Xác nhận mật khẩu</label>
                    <div class="input-group">
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control rounded-start" required>
                        <span class="input-group-text bg-light eye-container">
                            <i class="fas fa-eye toggle-password" data-target="password_confirmation"></i>
                        </span>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label">Vai trò</label>
                    <select name="role" id="role" class="form-select" required>
                        <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>Học viên</option>
                        <option value="teacher" {{ old('role') == 'teacher' ? 'selected' : '' }}>Giảng viên</option>
                    </select>
                    @error('role')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
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

@section('scripts')
<script>
    function togglePassword(fieldId) {
        const field = document.getElementById(fieldId);
        const icon = document.querySelector(`.toggle-password[data-target="${fieldId}"]`);
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

    document.querySelectorAll('.toggle-password').forEach(icon => {
        icon.addEventListener('click', function() {
            const fieldId = this.getAttribute('data-target');
            togglePassword(fieldId);
        });
    });
</script>
@endsection

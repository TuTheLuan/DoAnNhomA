<!-- resources/views/settings.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="text-center py-3 mb-4 bg-success text-white rounded">
                <h1>Cài Đặt</h1>
            </div>

            <form method="POST" action="{{ route('settings.update') }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="username" class="form-label">Tên đăng nhập</label>
                    <input type="text" name="username" id="username" class="form-control rounded-start shadow-sm text-center" value="{{ old('username', Auth::user()->username) }}" required>
                    @error('username')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control rounded-start shadow-sm text-center" value="{{ old('email', Auth::user()->email) }}" required>
                    @error('email')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="new_password" class="form-label">Mật khẩu mới (để trống nếu không đổi)</label>
                    <div class="input-group">
                        <input type="password" name="new_password" id="new_password" class="form-control rounded-start text-center">
                        <span class="input-group-text bg-light eye-container">
                            <i class="fas fa-eye toggle-password" data-target="new_password"></i>
                        </span>
                    </div>
                    @error('new_password')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="new_password_confirmation" class="form-label">Xác nhận mật khẩu mới</label>
                    <div class="input-group">
                        <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control rounded-start text-center">
                        <span class="input-group-text bg-light eye-container">
                            <i class="fas fa-eye toggle-password" data-target="new_password_confirmation"></i>
                        </span>
                    </div>
                </div>

                <button type="submit" class="btn btn-success d-block mx-auto mt-3 rounded-pill">
                    Cập Nhật
                </button>
            </form>
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

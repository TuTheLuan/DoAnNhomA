{{-- resources/views/user/settings.blade.php --}}
@extends('layouts.app')

@section('title', 'Cài Đặt')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <!-- Tiêu đề -->
            <div class="text-center py-3 mb-4 bg-success text-white rounded">
                <h1>Cài Đặt</h1>
            </div>

            <!-- Thông báo thành công -->
            @if (session('success'))
                <div class="alert alert-success text-center">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Form Cài Đặt -->
            <form method="POST" action="{{ route('settings.update') }}" id="settings-form">
                @csrf
                @method('PUT')

                <!-- Tên đăng nhập -->
                <div class="mb-3">
                    <label for="username" class="form-label">Tên đăng nhập</label>
                    <input type="text" name="username" id="username" 
                           class="form-control rounded-start shadow-sm" 
                           value="{{ old('username', $user->username) }}" required>
                    @error('username')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" 
                           class="form-control rounded-start shadow-sm" 
                           value="{{ old('email', $user->email) }}" required>
                    @error('email')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>


                <!-- Mật khẩu mới -->
                <div class="mb-3">
                    <label for="new_password" class="form-label">Mật khẩu mới</label>
                    <div class="input-group">
                        <input type="password" name="new_password" id="new_password" 
                               class="form-control rounded-start">
                        <span class="input-group-text bg-light eye-container">
                            <i class="fas fa-eye toggle-password" data-target="new_password"></i>
                        </span>
                    </div>
                    @error('new_password')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Xác nhận mật khẩu mới -->
                <div class="mb-3">
                    <label for="new_password_confirmation" class="form-label">Xác nhận mật khẩu mới</label>
                    <div class="input-group">
                        <input type="password" name="new_password_confirmation" id="new_password_confirmation" 
                               class="form-control rounded-start">
                        <span class="input-group-text bg-light eye-container">
                            <i class="fas fa-eye toggle-password" data-target="new_password_confirmation"></i>
                        </span>
                    </div>
                </div>

                <!-- Nút hành động -->
                <div class="d-flex justify-content-between mt-4">
                    <button type="submit" class="btn btn-success rounded-pill">Cập Nhật</button>
                    <button type="button" class="btn btn-danger rounded-pill" onclick="resetForm()">Huỷ Bỏ</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Lưu lại giá trị ban đầu của form khi trang được load
    const initialFormData = {
        username: "{{ $user->username }}",
        email: "{{ $user->email }}"
    };

    // Hàm toggle mật khẩu
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

    // Gán sự kiện cho tất cả toggle-password
    document.querySelectorAll('.toggle-password').forEach(icon => {
        icon.addEventListener('click', function() {
            const fieldId = this.getAttribute('data-target');
            togglePassword(fieldId);
        });
    });

    // Hàm reset form: đặt lại các trường về giá trị ban đầu và xoá password
    function resetForm() {
    document.getElementById('username').value = initialFormData.username;
    document.getElementById('email').value = initialFormData.email;
    // Xoá mật khẩu mới
    document.getElementById('new_password').value = '';
    document.getElementById('new_password_confirmation').value = '';

    ['new_password', 'new_password_confirmation'].forEach(fieldId => {
        const field = document.getElementById(fieldId);
        field.type = 'password';
        const icon = document.querySelector(`.toggle-password[data-target="${fieldId}"]`);
        if (icon) {
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });
}

</script>
@endsection

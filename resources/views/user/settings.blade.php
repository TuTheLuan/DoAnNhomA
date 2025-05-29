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

                <!-- Thông tin tài khoản -->
                <div class="card mb-4">
                    <div class="card-header">Thông tin tài khoản</div>
                    <div class="card-body">
                        <!-- Tên đăng nhập -->
                        <div class="mb-3">
                            <label for="username" class="form-label">Tên đăng nhập</label>
                            <input type="text" name="username" id="username" 
                                   class="form-control shadow-sm" 
                                   value="{{ old('username', $user->username) }}" required>
                            @error('username')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" 
                                   class="form-control shadow-sm" 
                                   value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Bảo mật -->
                <div class="card mb-4">
                    <div class="card-header">Bảo mật</div>
                    <div class="card-body">
                        <!-- Mật khẩu mới -->
                        <div class="mb-3">
                            <label for="new_password" class="form-label">Mật khẩu mới</label>
                            <div>
                                <input type="text" name="new_password" id="new_password" 
                                       class="form-control">
                            </div>
                            @error('new_password')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Xác nhận mật khẩu mới -->
                        <div class="mb-3">
                            <label for="new_password_confirmation" class="form-label">Xác nhận mật khẩu mới</label>
                            <div>
                                <input type="text" name="new_password_confirmation" id="new_password_confirmation" 
                                       class="form-control">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Nút hành động -->
                <div class="d-flex justify-content-between mt-4">
                    <button type="submit" class="btn btn-success rounded-pill">Cập Nhật</button>
                    <button type="button" class="btn btn-danger rounded-pill">Huỷ Bỏ</button>
                </div>
            </form>

            <!-- Form ẩn để xóa tài khoản -->
            <form id="delete-account-form" action="{{ route('settings.delete') }}" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
            </form>

            <!-- Phần Xóa Tài Khoản -->
            <div class="card mt-4">
                <div class="card-header">Xóa Tài Khoản</div>
                <div class="card-body">
                    <p>Hành động này sẽ xóa vĩnh viễn tài khoản của bạn và tất cả dữ liệu liên quan. Không thể hoàn tác!</p>
                    <button type="button" class="btn btn-danger" id="delete-account-button">Xóa Tài Khoản Vĩnh Viễn</button>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

{{-- Move the script block here --}}
<script>
    console.log('Settings script loaded (moved)'); // Log to check if the script block is executed
    document.addEventListener('DOMContentLoaded', function () {
        console.log('DOMContentLoaded fired (moved)'); // Log to confirm DOMContentLoaded
        // Lưu lại giá trị ban đầu của form khi trang được load
        const initialFormData = {
            username: "{{ $user->username }}",
            email: "{{ $user->email }}"
        };

        // Hàm toggle mật khẩu (giữ lại phòng trường hợp cần)
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

        // Gán sự kiện cho tất cả toggle-password (giữ lại phòng trường hợp cần)
        document.querySelectorAll('.toggle-password').forEach(icon => {
            icon.addEventListener('click', function(event) {
                event.preventDefault();
                event.stopPropagation();
                const fieldId = this.getAttribute('data-target');
                togglePassword(fieldId);
            });
        });

        // Hàm reset form: đặt lại các trường về giá trị ban đầu và xoá password
        function resetForm() {
            Swal.fire({
                title: 'Bạn có chắc chắn?',
                text: "Mọi thay đổi chưa lưu sẽ bị mất!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Có, hủy bỏ!',
                cancelButtonText: 'Không'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('username').value = initialFormData.username;
                    document.getElementById('email').value = initialFormData.email;
                    // Xoá mật khẩu mới
                    document.getElementById('new_password').value = '';
                    document.getElementById('new_password_confirmation').value = '';

                    // Reset password field types and icons if they were toggled (though icons are removed now)
                    ['new_password', 'new_password_confirmation'].forEach(fieldId => {
                        const field = document.getElementById(fieldId);
                        field.type = 'password'; // Reset to password type
                        // No icon logic needed as icons are removed
                    });

                    Swal.fire(
                        'Đã hủy!',
                        'Các thay đổi đã được hủy bỏ.',
                        'success'
                    );
                }
            });
        }

        // Gán sự kiện cho nút Huỷ Bỏ
        const cancelButton = document.querySelector('.btn-danger.rounded-pill[type="button"]');
        if (cancelButton) {
             cancelButton.addEventListener('click', function(event) {
                console.log('Cancel button clicked'); // Log to check if event listener is triggered
                event.preventDefault(); // Prevent default button action
                resetForm(); // Call the resetForm function
            });
        }


        // Gán sự kiện cho form submit (nút Cập Nhật)
        const settingsForm = document.getElementById('settings-form');
        if (settingsForm) {
            settingsForm.addEventListener('submit', function(event) {
                console.log('Update form submitted'); // Log to check if submit event listener is triggered
                event.preventDefault(); // Prevent default form submission

                Swal.fire({
                    title: 'Xác nhận cập nhật?',
                    text: "Bạn có muốn lưu lại các thay đổi?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Có, cập nhật!',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Manually submit the form
                        event.target.submit();
                    }
                });
            });
        }


        // Gán sự kiện cho nút Xóa Tài Khoản
        const deleteButton = document.getElementById('delete-account-button');
        if (deleteButton) {
            deleteButton.addEventListener('click', function() {
                console.log('Delete Account button clicked'); // Log to check if event listener is triggered
                Swal.fire({
                    title: 'Bạn có chắc chắn?',
                    text: "Bạn sẽ không thể khôi phục tài khoản này sau khi xóa!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Có, xóa tài khoản của tôi!',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Gửi form xóa tài khoản
                        document.getElementById('delete-account-form').submit();
                    }
                });
            });
        }
    }); // End DOMContentLoaded

</script>

@push('styles')
<style>
    /* General form styling */
    #settings-form {
        padding: 30px;
        border-radius: 10px; /* Slightly more rounded */
        background-color: #fff;
        box-shadow: 0 0.2rem 0.4rem rgba(0, 0, 0, 0.1); /* Slightly deeper shadow */
        margin-bottom: 30px;
    }

    .card {
        border-radius: 8px;
        overflow: hidden;
        border: 1px solid rgba(0, 0, 0, 0.125);
    }

    .card-header {
        background-color: #f8f9fa;
        font-weight: bold;
        padding: 1rem 1.5rem; /* Increased padding */
        border-bottom: 1px solid rgba(0, 0, 0, 0.125);
        font-size: 1.1rem;
    }

    .card-body {
        padding: 1.5rem; /* Increased padding */
    }

    .mb-3 {
        margin-bottom: 1.25rem !important; /* Increased spacing */
    }

    /* Style for form controls */
    #settings-form .form-control {
        border-radius: 5px;
        border: 1px solid #ced4da;
        box-shadow: inset 0 1px 3px rgba(0,0,0,.1); /* Slightly deeper inner shadow */
        padding: .6rem .8rem; /* Slightly more padding */
        transition: border-color .2s ease-in-out, box-shadow .2s ease-in-out; /* Slightly longer transition */
    }

    #settings-form .form-control:focus {
        border-color: #007bff; /* Primary blue color on focus */
        outline: 0;
        box-shadow: 0 0 0 .25rem rgba(0,123,255,.25); /* Standard blue focus shadow */
    }

    /* Button styling */
    .btn {
        border-radius: 5px;
        padding: .6rem 1.2rem;
        font-size: 1rem;
        font-weight: bold;
    }

    .btn:hover {
        /* Removed hover effects */
    }

    .btn-success {
         background-color: #28a745;
         border-color: #28a745;
    }

    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
    }

    /* Removed hover effects for specific button colors */
    /*
    .btn-success:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }

     .btn-danger:hover {
        background-color: #c82333;
        border-color: #bd2130;
    }
    */

    /* Center form title */
    .container .row.justify-content-center .col-md-6 .text-center h1 {
        font-size: 2rem;
        margin-bottom: 0;
    }

</style>
@endpush

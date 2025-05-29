<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Quản Lý Học Viên</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="{{ asset('js/script.js') }}" defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous" />
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 sidebar">
                <div class="admin-info text-center">
                    <img src="{{ asset('images/admin.png') }}" alt="Admin">
                    <p>{{ auth()->user()->name ?? 'Tài khoản' }}</p>
                </div>

                @php
                    $user = auth()->user();
                @endphp

                <ul class="nav flex-column">
                    {{-- Home --}}
                    <li class="nav-item">
                        @if ($user && $user->role === 'teacher')
                            <a href="{{ route('teacher.home') }}" class="nav-link">🏠 Trang chủ (GV)</a>
                        @elseif ($user && $user->role === 'student')
                            <a href="{{ route('students.home') }}" class="nav-link">🏠 Trang chủ (HV)</a>
                        @else
                            <a href="{{ route('guest.home') }}" class="nav-link">🏠 Trang chủ (Khách)</a>
                        @endif
                    </li>


                    {{-- Quản lý học viên (GV) --}}

                    <li class="nav-item"><a href="{{ route('students.khoahoc') }}" class="nav-link">📖 Khóa Học</a></li>
                    <li class="nav-item"><a href="{{ route('diendan.index.students') }}" class="nav-link">📰 Diễn đàn</a></li>

                    <li class="nav-item">
                        @if ($user && $user->role === 'teacher')
                            <a href="{{ route('teacher.student.list') }}" class="nav-link">📚 Quản lý Học Viên</a>
                        @else
                            <a href="#" class="nav-link disabled" onclick="event.preventDefault();" title="Chỉ dành cho giảng viên">📚 Quản lý Học Viên</a>
                        @endif
                    </li>

                    {{-- Khóa học --}}
                    <li class="nav-item">
                        @if ($user && $user->role === 'teacher')
                            <a href="{{ route('teacher.khoahoc') }}" class="nav-link">📖 Khóa học</a>
                        @elseif ($user && $user->role === 'student')
                            <a href="{{ route('students.khoahoc') }}" class="nav-link">📖 Khóa học</a>
                        @else
                            <a href="#" class="nav-link disabled" title="Chỉ dành cho thành viên">📖 Khóa học</a>
                        @endif
                    </li>

                    {{-- Diễn đàn --}}
                    <li class="nav-item">
                        @if ($user && $user->role === 'teacher')
                            <a href="{{ route('diendan.index') }}" class="nav-link">📰 Diễn đàn</a>
                        @elseif ($user && $user->role === 'student')
                            <a href="{{ route('diendan.index.students') }}" class="nav-link">📰 Diễn đàn</a>
                        @else
                            <a href="#" class="nav-link disabled" title="Chỉ dành cho thành viên">📰 Diễn đàn</a>
                        @endif
                    </li>

                    {{-- Thống kê --}}
                    <li class="nav-item">
                        @if ($user && $user->role === 'teacher')
                            <a href="{{ route('teacher.thongke') }}" class="nav-link">📊 Thống kê</a>
                        @elseif ($user && $user->role === 'student')
                            <a href="{{ route('students.thongke') }}" class="nav-link">📊 Thống kê</a>
                        @else
                            <a href="#" class="nav-link disabled" title="Không có quyền truy cập">📊 Thống kê</a>
                        @endif
                    </li>

                    {{-- Cài đặt --}}
                    <li class="nav-item">
                        <a href="{{ route('settings.edit') }}" class="nav-link">⚙️ Cài đặt</a>
                    </li>

                    {{-- Đăng xuất --}}
                    <li class="nav-item">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <a href="#" id="logout-link" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            🚪 Đăng Xuất
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Nội dung chính -->
            <div class="col-md-10 content">
                @yield('content')
            </div>
        </div>
    </div>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/script.js') }}"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Thành công!',
                text: '{{ session('success') }}',
                timer: 2500,
                showConfirmButton: false
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Lỗi!',
                text: '{{ session('error') }}',
                showConfirmButton: true
            });
        @endif

        @if(session('warning'))
            Swal.fire({
                icon: 'warning',
                title: 'Cảnh báo!',
                text: '{{ session('warning') }}',
                showConfirmButton: true
            });
        @endif

        // Xử lý logout
        var logoutLink = document.getElementById('logout-link');
        if (logoutLink) {
            logoutLink.addEventListener('click', function () {
                logoutLink.style.pointerEvents = 'none';
                logoutLink.style.opacity = '0.6';
                // Gửi form logout nếu có
                var form = document.getElementById('logout-form');
                if (form) form.submit();
            });
        }

        // Ngăn back về trang đã logout
        window.history.pushState(null, '', window.location.href);
        window.onpopstate = function () {
            window.location.reload();
        };
    });
</script>

@stack('scripts')

</body>
</html>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Quản Lý Học Viên</title>

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
                    <p>Admin 1</p>
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item"><a href="{{ route('students.home') }}" class="nav-link">🏠 Home</a></li>
                    @php
                        $user = auth()->user();
                    @endphp
                    <li class="nav-item">
                        @if($user && in_array($user->role, ['admin', 'teacher']))
                            <a href="{{ route('students.index') }}" class="nav-link">📚 Học Viên</a>
                        @else
                            <a href="#" class="nav-link disabled" onclick="event.preventDefault();" title="Bạn không có quyền truy cập">📚 Học Viên</a>
                        @endif
                    </li>
                    <li class="nav-item"><a href="{{ route('students.khoahoc') }}" class="nav-link">📖 Khóa Học</a></li>
                    <li class="nav-item"><a href="{{ route('diendan.index.students') }}" class="nav-link">📰 Diễn đàn</a></li>
                    <li class="nav-item">
                        @if($user && in_array($user->role, ['admin', 'teacher']))
                            <a href="{{ route('students.thongke') }}" class="nav-link">📊 Thống Kê</a>
                        @else
                            <a href="#" class="nav-link disabled" onclick="event.preventDefault();" title="Bạn không có quyền truy cập">📊 Thống Kê</a>
                        @endif
                    </li>
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

@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Danh sách khóa học mở</h1>
        <div class="btn-group">
            <a href="{{ route('students.khoahoc') }}" class="btn btn-outline-primary">
                <i class="bi bi-arrow-left"></i> Quay lại
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            @if($courses->count() > 0)
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @foreach($courses as $course)
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ asset('images/course-placeholder.jpg') }}" class="card-img-top" alt="Ảnh khóa học" style="height: 180px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $course->ten_khoa_hoc }}</h5>
                            <p class="card-text text-muted">
                                <i class="bi bi-person"></i> Giảng viên: {{ $course->teacher->name }}
                            </p>
                            <p class="card-text text-muted">
                                <i class="bi bi-book"></i> Mã khóa học: {{ $course->ma_khoa_hoc }}
                            </p>
                        </div>
                        <div class="card-footer bg-transparent">
                            <a href="#" class="btn btn-outline-primary w-100">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
                @endforeach

                <!-- Card mẫu thêm vào -->
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ asset('images/course-placeholder.jpg') }}" class="card-img-top" alt="Ảnh khóa học" style="height: 180px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">Lập trình Python cơ bản</h5>
                            <p class="card-text text-muted">
                                <i class="bi bi-person"></i> Giảng viên: Nguyễn Văn C
                            </p>
                            <p class="card-text text-muted">
                                <i class="bi bi-book"></i> Mã khóa học: KH003
                            </p>
                        </div>
                        <div class="card-footer bg-transparent">
                            <a href="#" class="btn btn-outline-primary w-100">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="alert alert-info">
                <i class="bi bi-info-circle"></i> Hiện không có khóa học nào mở
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Danh sách khóa học</h1>
        <a href="{{ route('students.khoahoccuatoi') }}" class="btn btn-primary">
            <i class="bi bi-bookmark-check"></i> Khóa học của tôi
        </a>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        @isset($courses)
            @foreach($courses as $course)
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('images/course-placeholder.jpg') }}" class="card-img-top" alt="Ảnh khóa học" style="height: 180px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $course->ten_khoa_hoc }}</h5>
                        <p class="card-text text-muted">
                            <i class="bi bi-person"></i> Giảng viên: {{ $course->teacher->name }}
                        </p>
                    </div>
                    <div class="card-footer bg-transparent">
                        <a href="#" class="btn btn-outline-primary w-100">Xem chi tiết</a>
                    </div>
                </div>
            </div>
            @endforeach
        @else
            <div class="col-12 text-center py-5">
                <div class="alert alert-info">
                    <i class="bi bi-info-circle"></i> Hiện không có khóa học nào
                </div>
            </div>
        @endisset
    </div>
</div>
@endsection

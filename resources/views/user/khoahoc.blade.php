@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4 text-center">KHÓA HỌC CỦA HỌC VIÊN</h2>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach($khoahocs as $khoahoc)
        <div class="col">
            <div class="card h-100 shadow-sm">
                <img src="{{ asset('images/' . $khoahoc->anh) }}" class="card-img-top" alt="Hình ảnh khóa học" style="height: 180px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">{{ $khoahoc->ten }}</h5>
                    <p class="card-text">Giảng viên: {{ $khoahoc->giangvien ?? 'Đang cập nhật' }}</p>
                    <p class="card-text">Số bài học: {{ $khoahoc->sobaihoc ?? 'Đang cập nhật' }}</p>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ route('user.baihoc', $khoahoc->id) }}" class="btn btn-danger">Học</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

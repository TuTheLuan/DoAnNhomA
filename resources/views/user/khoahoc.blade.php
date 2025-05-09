@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Danh sách khóa học</h1>
    </div>
    
    <!-- Thanh tìm kiếm và bộ lọc -->
    <div class="row mb-4">
        <div class="col-md-8">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Tìm kiếm khóa học...">
                <button class="btn btn-primary" type="button">
                    <i class="bi bi-search"></i> Tìm kiếm
                </button>
            </div>
        </div>
    </div>

    <!-- Danh sách khóa học -->
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

    <!-- Phân trang -->
    <div class="d-flex justify-content-center">
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">Trước</a>
                </li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">Tiếp</a>
                </li>
            </ul>
        </nav>
    </div>
</div>
@endsection

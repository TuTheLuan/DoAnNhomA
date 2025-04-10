@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Danh sách khóa học</h1>
        <a href="{{ route('students.khoahoccuatoi') }}" class="btn btn-primary">
            <i class="bi bi-bookmark-check"></i> Khóa học của tôi
        </a>
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
        <div class="col-md-4">
            <select class="form-select">
                <option selected>Lọc theo loại</option>
                <!-- Nội dung -->
            </select>
        </div>
    </div>

    <!-- Danh sách khóa học -->
    <div class="row">
        <div class="col-12 text-center">
            <div class="alert alert-info">
               <!-- Nội dung -->
            </div>
        </div>
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

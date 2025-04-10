@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Khóa học của tôi</h1>
        <a href="{{ route('students.khoahoc') }}" class="btn btn-outline-primary">
            <i class="bi bi-arrow-left"></i> Quay lại danh sách khóa học
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="alert alert-info">
                <i class="bi bi-info-circle"></i> Danh sách các khóa học bạn đã đăng ký sẽ hiển thị tại đây
            </div>
            
            <!-- Có thể thêm bảng hiển thị khóa học sau này -->
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Tên khóa học</th>
                        <th>Ngày đăng ký</th>
                        <th>Tiến độ</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Dữ liệu khóa học sẽ được thêm sau -->
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

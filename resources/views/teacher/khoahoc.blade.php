@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h3><i class="bi bi-book"></i> Quản lý Khóa học</h3>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <a href="#" class="btn btn-success">
                    <i class="bi bi-plus-circle"></i> Thêm khóa học mới
                </a>
            </div>
            
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Mã KH</th>
                            <th>Tên khóa học</th>
                            <th>Tên giảng viên</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Nội dung -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

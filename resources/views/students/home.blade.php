@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Chào mừng bạn đến với Hệ thống Học Trực Tuyến</h1>
    <div class="row">
        <!-- Khóa học hiện tại -->
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">Khóa học của tôi</h5>
                </div>
                <div class="card-body">
                    <p>{{ $soKhoaHoc ?? 0 }}</p>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ route('students.khoahoc') }}" class="btn btn-outline-primary">Xem tất cả khóa học</a>
                </div>
            </div>
        </div>

        <!-- Hoạt động gần đây -->
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-header bg-info text-white">
                    <h5 class="card-title mb-0">Số diễn đàn</h5>
                </div>
                <div class="card-body">
                    <p>{{ $soDienDan ?? 0 }}</p>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ route('diendan.index') }}" class="btn btn-outline-info">Xem chi tiết</a>
                </div>
            </div>
        </div>

        <!-- Thông báo & Deadline -->
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-header bg-warning text-dark">
                    <h5 class="card-title mb-0">Thông báo</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @if(!empty($thongBaoMoiNhat) && $thongBaoMoiNhat->count() > 0)
                            @foreach($thongBaoMoiNhat as $thongBao)
                                <li class="list-group-item">{{ $thongBao->tieu_de ?? 'Không có tiêu đề' }}</li>
                            @endforeach
                        @else
                            <li class="list-group-item">Không có thông báo mới</li>
                        @endif
                    </ul>
                </div>
                <div class="card-footer text-center">
                    <a href="#" class="btn btn-outline-warning">Xem tất cả thông báo</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

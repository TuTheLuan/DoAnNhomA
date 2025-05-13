@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">

        <div class="col-md-9">
            <!-- Main content -->
            <div class="card">
                <div class="card-header">
                    <h4>Chào mừng giảng viên đến với trang chủ của Giảng Viên</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="card text-white bg-success">
                                <div class="card-body">
                                    <h5 class="card-title">Số khóa học</h5>
                                    <p class="card-text">{{ $soKhoaHoc ?? 0 }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card text-white bg-info">
                                <div class="card-body">
                                    <h5 class="card-title">Số diễn đàn</h5>
                                    <p class="card-text">{{ $soDienDan ?? 0 }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card text-white bg-warning">
                                <div class="card-body">
                                    <h5 class="card-title">Học viên</h5>
                                    <p class="card-text">{{ $soHocVien ?? 0 }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <h5>Thông báo mới nhất</h5>
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

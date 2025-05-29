@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Quản lý diễn đàn</h2>
                <a href="{{ route('diendan.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Thêm diễn đàn mới
                </a>
            </div>

            @include('partials.diendan_search', ['action' => route('diendan.index')])

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    @if($diendans->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Mã diễn đàn</th>
                                        <th>Tên diễn đàn</th>
                                        <th>Ảnh nền</th>
                                        <th>Ảnh đính kèm</th>
                                        <th>Loại thảo luận</th>
                                        <th>Giảng viên</th>
                                        <th>Ngày tạo</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($diendans as $diendan)
                                        <tr>
                                            <td>{{ $diendan->ma_dien_dan }}</td>
                                            <td>{{ $diendan->ten_dien_dan }}</td>
                                            <td>
                                                @if($diendan->background_image && Storage::disk('public')->exists($diendan->background_image))
                                                    <img src="{{ asset('storage/' . $diendan->background_image) }}" 
                                                        alt="Ảnh nền" class="img-thumbnail"
                                                        style="width: 50px; height: 50px; object-fit: cover;">
                                                @else
                                                    <span class="text-muted">Không có</span>
                                                @endif
                                            </td>
                                            <td>
                                                @php
                                                    $validImages = [];
                                                    if (!empty($diendan->images)) {
                                                        $decodedImages = is_string($diendan->images) ? json_decode($diendan->images, true) : $diendan->images;
                                                        if (is_array($decodedImages)) {
                                                            $validImages = array_filter($decodedImages, function($image) {
                                                                return Storage::disk('public')->exists($image);
                                                            });
                                                        }
                                                    }
                                                @endphp

                                                @if(count($validImages) > 0)
                                                    <div class="d-flex gap-2">
                                                        @foreach(array_slice($validImages, 0, 3) as $index => $image)
                                                            <div class="position-relative">
                                                                <img src="{{ asset('storage/' . $image) }}" 
                                                                    alt="Ảnh đính kèm" 
                                                                    class="img-thumbnail"
                                                                    style="width: 50px; height: 50px; object-fit: cover;">
                                                                @if($index == 2 && count($validImages) > 3)
                                                                    <span class="position-absolute top-0 end-0 badge bg-secondary">
                                                                        +{{ count($validImages) - 3 }}
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <span class="text-muted">Không có</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($diendan->loai_thao_luan == 'public')
                                                    <span class="badge bg-success">Công khai</span>
                                                @else
                                                    <span class="badge bg-warning">Ẩn danh</span>
                                                @endif
                                            </td>
                                            <td>{{ $diendan->ten_giang_vien }}</td>
                                            <td>{{ date('d/m/Y', strtotime($diendan->ngay_tao)) }}</td>
                                            <td>
                                                <a href="{{ route('diendan.chat', $diendan->id) }}" class="btn btn-info btn-sm">
                                                    <i class="fas fa-comments"></i>
                                                </a>
                                                <a href="{{ route('diendan.edit', $diendan->id) }}" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('diendan.destroy', $diendan->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa diễn đàn này?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center my-3">
                            {{ $diendans->links('pagination::bootstrap-5') }}
                        </div>
                    @else
                        <div class="text-center py-4">
                            <p class="text-muted mb-0">Không có diễn đàn nào.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

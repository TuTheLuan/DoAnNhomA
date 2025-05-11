@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3><i class="bi bi-chat-dots"></i> Quản lý diễn đàn</h3>
        </div>
        <div class="card-body">
            <div class="mb-3 d-flex justify-content-between align-items-center">
                <a href="{{ route('diendan.create') }}" class="btn btn-success">
                    <i class="bi bi-plus-circle"></i> Thêm diễn đàn mới
                </a>
                <div>
                    <small class="text-muted">Tổng số diễn đàn: {{ $diendans->total() }}</small>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Mã diễn đàn</th>
                            <th>Tiêu đề</th>
                            <th>Tên giảng viên</th>
                            <th>Ảnh nền</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($diendans as $diendan)
                        <tr>
                            <td><a href="{{ route('diendan.show', $diendan->id) }}">{{ $diendan->ma_dien_dan }}</a></td>
                            <td>{{ $diendan->ten_dien_dan }}</td>
                            <td>{{ $diendan->ten_giang_vien }}</td>
                            <td>
                                @if($diendan->background_image)
                                    <img src="{{ asset('storage/' . $diendan->background_image) }}"
                                        class="img-thumbnail"
                                        style="width: 60px; height: 60px; object-fit: cover;"
                                        alt="Ảnh diễn đàn">
                                @else
                                    <span class="text-muted">Không có ảnh</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-{{ $diendan->loai_thao_luan == 'public' ? 'primary' : 'warning' }}">
                                    {{ $diendan->loai_thao_luan == 'public' ? 'Công khai' : 'Ẩn danh' }}
                                </span>
                            </td>
                            <td class="d-flex gap-2">
                                <a href="{{ route('diendan.edit', $diendan->id) }}" class="btn btn-sm btn-primary" title="Sửa">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('diendan.destroy', $diendan->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa diễn đàn này?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Xóa">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center my-3">
                    {{ $diendans->links('pagination::bootstrap-5') }}
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

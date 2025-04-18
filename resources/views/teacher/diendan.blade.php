@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h3><i class="bi bi-book"></i> Quản lý diễn đàn</h3>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <a href="{{ route('diendan.create') }}" class="btn btn-success">
                    <i class="bi bi-plus-circle"></i> Thêm diễn đàn mới
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Mã diễn đàn</th>
                            <th>Tiêu đề</th>
                            <th>Ảnh</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($diendans as $diendan)
                        <tr>
                            <td>{{ $diendan->ma_dien_dan }}</td>
                            <td>{{ $diendan->ten_dien_dan }}</td>
                            <td>
                                {{-- Ảnh nền chính --}}
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
                                <a href="{{ route('diendan.edit', $diendan->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i> Sửa
                                </a>
                                <form action="{{ route('diendan.destroy', $diendan->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc muốn xóa diễn đàn này?')">
                                        <i class="fas fa-trash"></i> Xóa
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
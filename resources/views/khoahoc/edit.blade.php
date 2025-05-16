@extends('layouts.app')

@section('content')
<div class="container bg-white p-4 rounded shadow-sm mt-4">
    <h2 class="mb-4">Chỉnh sửa khóa học</h2>

    <!-- Hiển thị lỗi -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Có lỗi xảy ra:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                   <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('khoahoc.update', $khoahoc->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Tên khóa học -->
        <div class="mb-3">
            <label for="ten" class="form-label">Tên khóa học</label>
            <input type="text" name="ten" class="form-control" value="{{ old('ten', $khoahoc->ten) }}" required>
        </div>

        <!-- Giảng viên -->
        <div class="mb-3">
            <label for="giangvien" class="form-label">Giảng viên</label>
            <input type="text" name="giangvien" class="form-control" value="{{ old('giangvien', $khoahoc->giangvien) }}" required>
        </div>

        <!-- Số bài học -->
        <div class="mb-3">
            <label for="sobaihoc" class="form-label">Số bài học</label>
            <input type="number" name="sobaihoc" class="form-control" min="0" value="{{ old('sobaihoc', $khoahoc->sobaihoc) }}" required>
        </div>

        <!-- Ảnh -->
        <div class="mb-3">
            <label for="anh" class="form-label">Ảnh khóa học</label><br>
            @if($khoahoc->anh)
                <img src="{{ asset('images/' . $khoahoc->anh) }}" width="150" class="rounded shadow-sm mb-2">
            @endif
            <input type="file" name="anh" class="form-control">
        </div>

        <!-- Link Google Meet -->
        <div class="mb-3">
            <label for="meet_link" class="form-label">Link Google Meet</label>
            <input type="url" name="meet_link" class="form-control" value="{{ old('meet_link', $khoahoc->meet_link) }}">
        </div>

        <!-- Thời gian Meet -->
        <div class="mb-3">
            <label for="meet_time" class="form-label">Thời gian học Google Meet</label>
            <input type="text" name="meet_time" class="form-control" value="{{ old('meet_time', $khoahoc->meet_time) }}">
        </div>

        <!-- Thời gian bắt đầu và kết thúc -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="thoigian_batdau" class="form-label">Thời gian bắt đầu</label>
                <input type="date" name="thoigian_batdau" class="form-control" value="{{ old('thoigian_batdau', $khoahoc->thoigian_batdau) }}">
            </div>

            <div class="col-md-6 mb-3">
                <label for="thoigian_ketthuc" class="form-label">Thời gian kết thúc</label>
                <input type="date" name="thoigian_ketthuc" class="form-control" value="{{ old('thoigian_ketthuc', $khoahoc->thoigian_ketthuc) }}">
            </div>
        </div>

        <!-- Trạng thái -->
        <div class="mb-3">
            <label for="trangthai" class="form-label">Trạng thái</label>
            @php
                $status = old('trangthai', $khoahoc->trangthai);
            @endphp
            <select name="trangthai" class="form-select">
                <option value="Mở" {{ $status == 'Mở' ? 'selected' : '' }}>Mở</option>
                <option value="Đang diễn ra" {{ $status == 'Đang diễn ra' ? 'selected' : '' }}>Đang diễn ra</option>
                <option value="Kết thúc" {{ $status == 'Kết thúc' ? 'selected' : '' }}>Kết thúc</option>
                <option value="Ẩn" {{ $status == 'Ẩn' ? 'selected' : '' }}>Ẩn</option>
            </select>
        </div>

        <!-- Nút lưu -->
        <button type="submit" class="btn btn-success">
            <i class="fas fa-save"></i> Lưu thay đổi
        </button>

        <a href="{{ route('khoahoc.index') }}" class="btn btn-secondary ms-2">
            <i class="fas fa-arrow-left"></i> Quay lại
        </a>
    </form>
</div>
@endsection

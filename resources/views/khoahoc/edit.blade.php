@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Chỉnh sửa khóa học</h2>

    {{-- Hiển thị lỗi validate --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                   <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Hiển thị thông báo thành công --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('khoahoc.update', $khoahoc->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="ten" class="form-label">Tên khóa học</label>
            <input type="text" name="ten" class="form-control" value="{{ old('ten', $khoahoc->ten) }}" required>
        </div>

        <div class="mb-3">
            <label for="giangvien" class="form-label">Giảng viên</label>
            <input type="text" name="giangvien" class="form-control" value="{{ old('giangvien', $khoahoc->giangvien) }}" required>
        </div>

        <div class="mb-3">
            <label for="sobaihoc" class="form-label">Số bài học</label>
            <input type="number" name="sobaihoc" class="form-control" value="{{ old('sobaihoc', $khoahoc->sobaihoc) }}" required min="1">
        </div>

        <div class="mb-3">
            <label for="anh" class="form-label">Ảnh khóa học</label><br>

            @if($khoahoc->anh)
                <div class="mb-2">
                    <img src="{{ asset('images/' . $khoahoc->anh) }}" alt="Ảnh khóa học" width="150" class="rounded shadow-sm">
                </div>
            @endif

            <input type="file" name="anh" class="form-control" accept="image/*">
            <small class="text-muted">Nếu muốn thay đổi ảnh, chọn file mới.</small>
        </div>

        <div class="mb-3">
            <label for="meet_link" class="form-label">Link Google Meet</label>
            <input type="url" name="meet_link" class="form-control" value="{{ old('meet_link', $khoahoc->meet_link) }}" placeholder="https://meet.google.com/xxx-xxxx-xxx">
        </div>

        <div class="mb-3">
            <label for="meet_time" class="form-label">Thời gian học Google Meet</label>
            <input type="text" name="meet_time" class="form-control" value="{{ old('meet_time', $khoahoc->meet_time) }}" placeholder="Ví dụ: Thứ 2, 3, 5, 7 lúc 19h-21h">
        </div>

        <button type="submit" class="btn btn-success">Lưu thay đổi</button>
    </form>
</div>
@endsection

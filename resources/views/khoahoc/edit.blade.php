@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Chỉnh sửa khóa học</h2>
    <form action="{{ route('khoahoc.update', $khoahoc->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="ten" class="form-label">Tên khóa học</label>
        <input type="text" name="ten" class="form-control" value="{{ $khoahoc->ten }}">
    </div>

    <div class="mb-3">
        <label for="giangvien" class="form-label">Giảng viên</label>
        <input type="text" name="giangvien" class="form-control" value="{{ $khoahoc->giangvien }}">
    </div>

    <div class="mb-3">
        <label for="sobaihoc" class="form-label">Số Bài Học</label>
        <input type="number" name="sobaihoc" class="form-control" value="{{ $khoahoc->sobaihoc }}">
    </div>

    <div class="mb-3">
        <label for="anh" class="form-label">Ảnh khóa học</label><br>

        {{-- Hiển thị ảnh hiện tại nếu có --}}
        @if($khoahoc->anh)
            <div class="mb-2">
                <img src="{{ asset('images/' . $khoahoc->anh) }}" alt="Ảnh khóa học" width="150" class="rounded shadow-sm">
            </div>
        @endif


        {{-- Input thay đổi ảnh --}}
        <input type="file" name="anh" class="form-control">
    </div>

    <button type="submit" class="btn btn-success">Lưu thay đổi</button>
</form>

</div>
@endsection

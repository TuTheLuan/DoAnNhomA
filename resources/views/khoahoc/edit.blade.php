@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Chỉnh sửa khóa học</h2>
    <form action="{{ route('khoahoc.update', $khoahoc->id) }}" method="POST">
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

        <button type="submit" class="btn btn-success">Lưu thay đổi</button>
    </form>
</div>
@endsection

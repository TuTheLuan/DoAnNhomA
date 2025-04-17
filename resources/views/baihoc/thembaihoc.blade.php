@extends('layouts.app')

@section('content')
<div class="container mt-4" style="max-width: 600px;">
    <h3 class="text-center text-danger mb-4" style="text-shadow: 1px 1px 2px gray;">
        Thêm Bài Học - {{ $khoahoc->ten }}
    </h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('baihoc.store') }}" method="POST" enctype="multipart/form-data" class="bg-light p-4 rounded shadow-sm">
        @csrf

        <!-- ID Khóa học (ẩn) -->
        <input type="hidden" name="khoahoc_id" value="{{ $khoahoc->id }}">

        <div class="mb-3">
            <label for="so" class="form-label">Bài học số:</label>
            <input type="number" class="form-control" name="so" id="so" value="{{ old('so') }}" required>
        </div>

        <div class="mb-3">
            <label for="tieude" class="form-label">Tiêu đề bài học:</label>
            <input type="text" class="form-control" name="tieude" id="tieude" value="{{ old('tieude') }}" required>
        </div>

        <div class="mb-4">
            <label for="file" class="form-label">Tài liệu bài học:</label>
            <div class="input-group">
                <input type="file" class="form-control" name="file" id="file">
                <span class="input-group-text bg-white">
                    <img src="{{ asset('images/upload-icon.png') }}" alt="upload" style="height: 20px;">
                </span>
            </div>
            <small class="text-muted">Chấp nhận file PDF, Word, PowerPoint, TXT. Tối đa 2MB.</small>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('baihoc.danhsach', $khoahoc->id) }}" class="btn btn-danger">Hủy</a>
            <button type="submit" class="btn btn-success">Thêm Bài Học</button>
        </div>
    </form>
</div>
@endsection

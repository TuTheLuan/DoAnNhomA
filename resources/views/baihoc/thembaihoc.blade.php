@extends('layouts.app')

@section('content')
<div class="container mt-4" style="max-width: 600px;">
    <h3 class="text-center text-danger mb-4" style="text-shadow: 1px 1px 2px gray;">Thêm Bài Học</h3>

    <form action="{{ route('lessons.store') }}" method="POST" enctype="multipart/form-data" class="bg-light p-4 rounded shadow-sm">
        @csrf
        <div class="mb-3">
            <label for="lesson_number" class="form-label">Bài học số:</label>
            <input type="number" class="form-control" name="lesson_number" id="lesson_number" required>
        </div>

        <div class="mb-3">
            <label for="title" class="form-label">Tiêu đề bài học:</label>
            <input type="text" class="form-control" name="title" id="title" required>
        </div>

        <div class="mb-4">
            <label for="file" class="form-label">Tài liệu bài học:</label>
            <div class="input-group">
                <input type="file" class="form-control" name="file" id="file" required>
                <span class="input-group-text bg-white">
                    <img src="{{ asset('images/upload-icon.png') }}" alt="upload" style="height: 20px;">
                </span>
            </div>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('lessons.index') }}" class="btn btn-danger">Hủy</a>
            <button type="submit" class="btn btn-success">Thêm</button>
        </div>
    </form>
</div>
@endsection

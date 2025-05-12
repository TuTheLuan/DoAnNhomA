{{-- resources/views/baihoc/edit.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mt-4" style="max-width: 600px;">
    <h3 class="text-center text-warning mb-4" style="text-shadow: 1px 1px 2px gray;">
        Chỉnh Sửa Bài Học 
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

    <form action="{{ route('baihoc.update', $baihoc->id) }}" method="POST" enctype="multipart/form-data" class="bg-light p-4 rounded shadow-sm">
        @csrf
        @method('PUT')

        <input type="hidden" name="khoahoc_id" value="{{ $baihoc->khoahoc_id }}">

        <div class="mb-3">
            <label for="so" class="form-label">Bài học số:</label>
            <input type="number" class="form-control" name="so" id="so" value="{{ old('so', $baihoc->so) }}" required>
        </div>

        <div class="mb-3">
            <label for="tieude" class="form-label">Tiêu đề bài học:</label>
            <input type="text" class="form-control" name="tieude" id="tieude" value="{{ old('tieude', $baihoc->tieude) }}" required>
        </div>

        <div class="mb-4">
            <label for="files" class="form-label">Thêm tài liệu mới (nếu có):</label>
            <div class="input-group">
                <input type="file" class="form-control" name="files[]" id="files" multiple>
                <span class="input-group-text bg-white">
                    <img src="{{ asset('images/upload-icon.png') }}" alt="upload" style="height: 20px;">
                </span>
            </div>
            <small class="text-muted">Bạn có thể chọn nhiều file: PDF, Word, PowerPoint, TXT. Tối đa mỗi file 2MB.</small>
            @error('files')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
            @if ($errors->has('files.*'))
                @foreach ($errors->get('files.*') as $messages)
                    @foreach ($messages as $msg)
                        <div class="text-danger mt-1">{{ $msg }}</div>
                    @endforeach
                @endforeach
            @endif
        </div>

        <div class="mb-4">
            <label class="form-label">Tài liệu đã có:</label>
            <ul class="list-group">
                @foreach ($baihoc->tailieu as $file)
                    <li class="list-group-item">
                        <a href="{{ asset('storage/' . $file->file) }}" target="_blank">{{ $file->original_name }}</a>
                    </li>
                @endforeach
            </ul>


        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('baihoc.danhsach', $baihoc->khoahoc_id) }}" class="btn btn-danger">Hủy</a>
            <button type="submit" class="btn btn-warning">Cập Nhật</button>
        </div>
    </form>
</div>
@endsection

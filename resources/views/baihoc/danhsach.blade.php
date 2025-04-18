@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="text-center text-danger mb-4" style="text-shadow: 1px 1px 2px gray;">
        Danh Sách Bài Học - {{ $khoahoc->ten_khoahoc }}
    </h2>

    <div class="row justify-content-between align-items-start">
        <div class="col-md-7">
            <div id="lessonList">
                @forelse ($baihocs as $baihoc)
                    <div class="lesson-box">
                        <div class="lesson-header" onclick="toggleLesson(this)">
                            Bài {{ $baihoc->so }}: {{ $baihoc->tieude }}
                            <span>&#9660;</span>
                        </div>
                        <div class="lesson-content">
                        @if ($baihoc->tailieu->count())
                            @foreach ($baihoc->tailieu as $tailieu)
                                @php
                                    $extension = strtolower(pathinfo($tailieu->file, PATHINFO_EXTENSION));
                                    switch ($extension) {
                                        case 'doc':
                                        case 'docx':
                                            $icon = asset('icons/word-icon.png');
                                            break;
                                        case 'pdf':
                                            $icon = asset('icons/pdf-icon.png');
                                            break;
                                        case 'ppt':
                                        case 'pptx':
                                            $icon = asset('icons/ppt-icon.png');
                                            break;
                                        case 'txt':
                                            $icon = asset('icons/txt-icon.png');
                                            break;
                                        default:
                                            $icon = asset('icons/file-icon.png');
                                    }
                                @endphp

                                <div class="file-item">
                                    <img src="{{ $icon }}" alt="file icon">
                                    <a href="{{ asset('storage/' . $tailieu->file) }}" target="_blank">
                                        Xem tài liệu
                                    </a>
                                    <span class="delete">x</span>
                                </div>
                            @endforeach
                        @else
                            <p>Chưa có tài liệu.</p>
                        @endif

                            <button class="edit-btn">Chỉnh sửa</button>
                        </div>
                    </div>
                @empty
                    <p>Chưa có bài học nào.</p>
                @endforelse
            </div>

            <div class="mt-3 d-flex gap-3">
                <a href="{{ route('baihoc.thembaihoc', ['id' => $khoahoc->id]) }}" class="btn btn-success">
                    Thêm Bài Học
                </a>

                <form action="{{ route('baihoc.xoaAll', $khoahoc->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa tất cả bài học của khóa học này?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Xóa Bài Học</button>
                </form>
            </div>

        </div>

        <div class="col-md-4 text-center">
            <img src="{{ asset('images/ai-hand.png') }}" alt="AI" class="img-fluid rounded shadow-sm">
        </div>
    </div>
</div>

<style>
    .lesson-box { background-color: #efefef; border-radius: 8px; padding: 10px; margin-bottom: 10px; border: 1px solid #ccc; }
    .lesson-header { display: flex; justify-content: space-between; cursor: pointer; font-weight: 600; background-color: #ddd; padding: 8px; border-radius: 6px; }
    .lesson-content { padding: 10px; display: none; background-color: #fff; margin-top: 5px; border-radius: 6px; }
    .file-item { display: flex; align-items: center; margin-bottom: 5px; }
    .file-item img { width: 24px; height: 24px; margin-right: 8px; }
    .file-item .delete { margin-left: auto; color: red; cursor: pointer; font-weight: bold; }
    .edit-btn { margin-top: 5px; background-color: #5cb85c; color: white; padding: 3px 8px; border-radius: 5px; font-size: 14px; border: none; }
</style>

<script>
    function toggleLesson(header) {
        const content = header.nextElementSibling;
        const icon = header.querySelector('span');
        if (content.style.display === 'block') {
            content.style.display = 'none';
            icon.innerHTML = '&#9660;';
        } else {
            content.style.display = 'block';
            icon.innerHTML = '&#9650;';
        }
    }
</script>
@endsection

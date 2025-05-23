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
                                        <a href="{{ asset('storage/' . $tailieu->file) }}" target="_blank">{{ $tailieu->original_name }}</a>

                                        {{-- Form xóa tài liệu --}}
                                        <form class="delete-tailieu-form" action="{{ route('tailieu.destroy', $tailieu->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn-delete-tailieu" style="background: none; border: none; color: red; font-weight: bold; cursor: pointer;">x</button>
                                        </form>
                                    </div>
                                @endforeach
                            @else
                                <p>Chưa có tài liệu.</p>
                            @endif

                            {{-- Nút chỉnh sửa và xóa bài học --}}
                            <div class="d-flex gap-2 mt-2">
                                <a href="{{ route('baihoc.edit', $baihoc->id) }}" class="btn btn-sm btn-primary">Chỉnh sửa</a>

                                <form action="{{ route('baihoc.destroy', $baihoc->id) }}" method="POST" class="delete-lesson-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-danger delete-lesson-btn">Xóa</button>
                                </form>
                            </div>
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
            </div>
        </div>

        <div class="col-md-4 text-center">
            <h5 class="text-secondary mb-3" style="font-weight: 600;">
                Hình ảnh khóa học
            </h5>
            <div class="p-2 bg-white border rounded shadow-sm" style="display: inline-block;">
                <img src="{{ asset('images/' . $khoahoc->anh) }}" 
                    alt="Ảnh khóa học" 
                    class="img-fluid rounded" 
                    style="max-height: 250px; object-fit: cover;">
            </div>
        </div>
    </div>
</div>

{{-- CSS --}}
<style>
    .lesson-box { background-color: #efefef; border-radius: 8px; padding: 10px; margin-bottom: 10px; border: 1px solid #ccc; }
    .lesson-header { display: flex; justify-content: space-between; cursor: pointer; font-weight: 600; background-color: #ddd; padding: 8px; border-radius: 6px; }
    .lesson-content { padding: 10px; display: none; background-color: #fff; margin-top: 5px; border-radius: 6px; }
    .file-item { display: flex; align-items: center; margin-bottom: 5px; }
    .file-item img { width: 24px; height: 24px; margin-right: 8px; }
</style>

{{-- SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- Script toggle và xác nhận xóa --}}
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

    document.addEventListener('DOMContentLoaded', function () {
        // Xác nhận xóa bài học
        const deleteLessonButtons = document.querySelectorAll('.delete-lesson-btn');
        deleteLessonButtons.forEach(button => {
            button.addEventListener('click', function () {
                const form = this.closest('form');
                Swal.fire({
                    title: 'Bạn có chắc?',
                    text: "Thao tác này sẽ xóa bài học!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Vâng, xóa nó!',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        // Xác nhận xóa tài liệu
        const deleteTailieuButtons = document.querySelectorAll('.btn-delete-tailieu');
        deleteTailieuButtons.forEach(button => {
            button.addEventListener('click', function () {
                const form = this.closest('form');
                Swal.fire({
                    title: 'Xác nhận xóa?',
                    text: "Tài liệu này sẽ bị xóa vĩnh viễn.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Xóa',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endsection

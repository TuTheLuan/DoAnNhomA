@extends('layouts.app')

@section('content')
<div class="container">

    <h2 class="mb-4 text-center">Danh sách bài học  {{ $khoahoc->ten }}</h2>

    @if($baihocs->isEmpty())
        <p>Chưa có tài liệu hiển thị.</p>
    @else

    @foreach($baihocs as $index => $baihoc)
        <div class="card mb-4">
            <div class="card-header">
                Bài {{ $index + 1 }}: {{ $baihoc->tieude }}
            </div>
            <div class="card-body">
                @if($baihoc->taiLieu->isEmpty())
                    <p>Chưa có tài liệu cho bài học này.</p>
                @else
                    @foreach($baihoc->taiLieu as $tailieu)
                        <p>
                            <a href="{{ asset('upload/tailieu/' . $tailieu->file) }}" target="_blank">
                                {{ $tailieu->original_name }}
                            </a>
                        </p>
                    @endforeach
                @endif
            </div>
        </div>
    @endforeach
    @endif
</div>
@endsection

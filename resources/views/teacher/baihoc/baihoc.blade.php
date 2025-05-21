@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4 text-center">Danh sách bài học  {{ $khoahoc->ten_khoahoc }}</h2>
    <p>Chưa có bài học để hiển thị</p>
    @foreach($baihocs as $index => $baihoc)
        <div class="card mb-4">
            <div class="card-header">
                Bài {{ $index + 1 }}: {{ $baihoc->tieude }}
            </div>
            <div class="card-body">
            @foreach($baihocs as $baihoc)
                <div class="card">
                    
                    
                    {{-- Hiển thị tài liệu --}}
                    @foreach($baihoc->taiLieu as $tailieu)
                        <p>
                            <a href="{{ asset('upload/tailieu/' . $tailieu->file) }}" target="_blank">
                                {{ $tailieu->original_name }}
                            </a>
                        </p>
                    @endforeach
                </div>
            @endforeach
            </div>
        </div>
    @endforeach
</div>
@endsection

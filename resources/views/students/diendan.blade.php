@php
    // Hàm tạo số ngẫu nhiên cố định dựa trên tên người gửi
    function getAnonymousName($name) {
        $hash = substr(md5($name), 0, 4);
        return 'Ẩn danh ' . $hash;
    }
@endphp
@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Diễn đàn học viên</h1>
    
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    Hiển thị diễn đàn
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($diendans as $diendan)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                @if($diendan->background_image)
                                <img src="{{ asset('storage/' . $diendan->background_image) }}" class="card-img-top" alt="Ảnh bìa diễn đàn" style="height: 150px; object-fit: cover;">
                                @else
                                <div class="bg-secondary text-white text-center p-4" style="height: 150px;">
                                    <i class="fas fa-image fa-3x"></i>
                                </div>
                                @endif
                                <div class="card-body" style="text-align: center;">
                                    <h5 class="card-title">{{ $diendan->ten_dien_dan }}</h5>
                                    <p class="card-text text-muted">Giảng viên: {{ $diendan->ten_giang_vien }}</p>
                                </div>
                                <div class="card-footer bg-white">
                                    <a href="{{ route('diendan.chat', $diendan->id) }}" class="btn btn-primary btn-block">
                                        <i class="fas fa-sign-in-alt"></i> Tham gia
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="d-flex justify-content-center my-3">
                        {{ $diendans->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

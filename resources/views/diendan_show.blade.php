@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3>Chi tiết diễn đàn: {{ $diendan->ten_dien_dan }}</h3>
        </div>
        <div class="card-body">
            <p><strong>Mã diễn đàn:</strong> {{ $diendan->ma_dien_dan }}</p>
            <p><strong>Tiêu đề:</strong> {{ $diendan->ten_dien_dan }}</p>
            <p><strong>Giảng viên:</strong> {{ $diendan->ten_giang_vien }}</p>
            <p><strong>Loại thảo luận:</strong> {{ $diendan->loai_thao_luan == 'public' ? 'Công khai' : 'Ẩn danh' }}</p>
            <p><strong>Ngày tạo:</strong> {{ \Carbon\Carbon::parse($diendan->ngay_tao)->format('d/m/Y') }}</p>
            @if($diendan->background_image)
                <img src="{{ asset('storage/' . $diendan->background_image) }}" alt="Ảnh nền diễn đàn" class="img-fluid mb-3" style="max-height: 300px;">
            @endif

            <a href="{{ route('diendan.chat', $diendan->id) }}" class="btn btn-primary">
                <i class="fas fa-comments"></i> Vào chat diễn đàn
            </a>
        </div>
    </div>
</div>
@endsection

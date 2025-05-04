@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4 text-center">KHÓA HỌC CỦA HỌC VIÊN</h2>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach($khoahocs as $khoahoc)
        <div class="col">
            <div class="card h-100 shadow-sm">
                <img src="{{ asset('storage/' . $khoahoc->hinh_anh) }}" class="card-img-top" alt="Hình ảnh khóa học" style="height: 180px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">{{ $khoahoc->ten_khoahoc }}</h5>
                    <p class="card-text">Giảng viên: {{ $khoahoc->giang_vien }}</p>
                </div>
                <div class="card-footer text-center">
                    <a href="#" class="btn btn-danger">Học</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

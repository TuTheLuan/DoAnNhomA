@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="bg-white p-4 rounded shadow-sm border">

        <!-- Tiêu đề -->
        <h2 class="text-center text-danger mb-4" style="text-shadow: 1px 1px #999;">
            Thêm Khóa Học
        </h2>

        <!-- Nội dung biểu mẫu -->
        <form action="{{ route('khoahoc.store') }}" method="POST">
            @csrf
            <div class="row">
                <!-- Bên trái -->
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="ten-khoa-hoc" class="form-label fw-bold">Tên Khóa Học:</label>
                        <input type="text" name="ten" id="ten-khoa-hoc" class="form-control bg-light" placeholder="Nhập tên khóa học" required>
                    </div>

                    <div class="mb-3">
                        <label for="giang-vien" class="form-label fw-bold">Tên Giảng Viên:</label>
                        <input type="text" name="giangvien" id="giang-vien" class="form-control bg-light" placeholder="Nhập tên giảng viên" required>
                    </div>

                    <div class="mb-3">
                        <label for="so-bai-hoc" class="form-label fw-bold">Số Bài Học:</label>
                        <input type="number" name="sobaihoc" id="so-bai-hoc" class="form-control bg-light" placeholder="Nhập số bài học">
                    </div>
                </div>

                <!-- Bên phải -->
                <div class="col-md-4 text-center bg-light rounded p-4">
                    <i class="fas fa-image fa-3x mb-3 text-secondary"></i>
                    <div>
                        <a href="#" class="d-block text-primary fw-bold mb-2 text-decoration-underline">Tải tệp lên</a>
                        <p class="mb-0">Upload ảnh nền khóa học</p>
                    </div>
                </div>
            </div>

            <!-- Nút thao tác -->
            <div class="d-flex justify-content-center mt-4">
                <a href="{{ route('khoahoc.index') }}" class="btn btn-danger me-3 px-4">Hủy</a>
                <button type="submit" class="btn btn-success px-4">Thêm</button>
            </div>
        </form>

    </div>
</div>

<!-- Font Awesome -->
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/js/all.min.js" crossorigin="anonymous"></script>
@endpush
@endsection

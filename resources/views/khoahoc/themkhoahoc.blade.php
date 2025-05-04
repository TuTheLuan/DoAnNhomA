@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="bg-white p-4 rounded shadow-sm border">

        <!-- Tiêu đề -->
        <h2 class="text-center text-danger mb-4" style="text-shadow: 1px 1px #999;">
            Thêm Khóa Học
        </h2>

        <!-- Nội dung biểu mẫu -->
        <form action="{{ route('khoahoc.store') }}" method="POST" enctype="multipart/form-data" id="courseForm">
            @csrf
            <div class="row">
                <!-- Bên trái -->
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="ten-khoa-hoc" class="form-label fw-bold">Tên Khóa Học:</label>
                        <input type="text" name="ten" id="ten-khoa-hoc"
                               class="form-control bg-light @error('ten') is-invalid @enderror"
                               placeholder="Nhập tên khóa học" value="{{ old('ten') }}" required>
                        @error('ten')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="giang-vien" class="form-label fw-bold">Tên Giảng Viên:</label>
                        <input type="text" name="giangvien" id="giang-vien"
                               class="form-control bg-light @error('giangvien') is-invalid @enderror"
                               placeholder="Nhập tên giảng viên" value="{{ old('giangvien') }}" required>
                        @error('giangvien')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="so-bai-hoc" class="form-label fw-bold">Số Bài Học:</label>
                        <input type="number" name="sobaihoc" id="so-bai-hoc"
                               class="form-control bg-light @error('sobaihoc') is-invalid @enderror"
                               placeholder="Nhập số bài học" value="{{ old('sobaihoc') }}" required min="1">
                        @error('sobaihoc')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Bên phải -->
                <div class="mb-3">
                    <label for="anh" class="form-label fw-bold">Ảnh Khóa Học</label>
                    <input type="file" class="form-control @error('anh') is-invalid @enderror"
                           name="anh" accept="image/*">
                    @error('anh')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
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

    <script>
        document.getElementById('courseForm').addEventListener('submit', function(e) {
            const ten = document.getElementById('ten-khoa-hoc').value.trim();
            const giangvien = document.getElementById('giang-vien').value.trim();
            const regex = /^[a-zA-Z0-9\sÀ-ỹ]{7,}$/;

            if (ten.length < 7 || ten.length > 155 || !regex.test(ten)) {
                alert("Tên khóa học phải từ 7 đến 155 ký tự, không chứa ký tự đặc biệt.");
                e.preventDefault();
                return;
            }

            if (giangvien.length < 7 || giangvien.length > 55 || !regex.test(giangvien)) {
                alert("Tên giảng viên phải từ 7 đến 55 ký tự, không chứa ký tự đặc biệt.");
                e.preventDefault();
                return;
            }

            const sobaihoc = document.getElementById('so-bai-hoc').value;
            if (sobaihoc < 1 || isNaN(sobaihoc)) {
                alert("Số bài học phải là một số hợp lệ lớn hơn 0.");
                e.preventDefault();
                return;
            }
        });
    </script>
@endpush
@endsection

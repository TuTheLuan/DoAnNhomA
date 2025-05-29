@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="bg-white p-4 rounded shadow-sm border">

        <!-- Tiêu đề -->
        <h2 class="text-center text-danger mb-4" style="text-shadow: 1px 1px #999;">
            Thêm Khóa Học
        </h2>

        <!-- Nội dung biểu mẫu -->
        <form action="{{ route('teacher.khoahoc.luukhoahoc') }}" method="POST" enctype="multipart/form-data" id="courseForm">
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

                    <div class="mb-3">
                        <label for="meet_link" class="form-label fw-bold">Link Meet:</label>
                        <input type="url" name="meet_link" id="meet_link"
                               class="form-control bg-light @error('meet_link') is-invalid @enderror"
                               placeholder="Nhập link meet" value="{{ old('meet_link') }}">
                        @error('meet_link')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="meet_time" class="form-label fw-bold">Thời Gian Meet:</label>
                        <input type="text" name="meet_time" id="meet_time"
                               class="form-control bg-light @error('meet_time') is-invalid @enderror"
                               placeholder="Ví dụ: Thứ 2, Lúc 19H" value="{{ old('meet_time') }}">
                        @error('meet_time')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="trangthai" class="form-label fw-bold">Trạng Thái:</label>
                        <select name="trangthai" id="trangthai"
                                class="form-select bg-light @error('trangthai') is-invalid @enderror" required>
                            <option value="">-- Chọn trạng thái --</option>
                            <option value="Mở" {{ old('trangthai') == 'Mở' ? 'selected' : '' }}>Mở</option>
                            <option value="Đang diễn ra" {{ old('trangthai') == 'Đang diễn ra' ? 'selected' : '' }}>Đang diễn ra</option>
                            <option value="Kết thúc" {{ old('trangthai') == 'Kết thúc' ? 'selected' : '' }}>Kết thúc</option>
                            <option value="Ẩn" {{ old('trangthai') == 'Ẩn' ? 'selected' : '' }}>Ẩn</option>
                        </select>
                        @error('trangthai')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="thoigian_batdau" class="form-label fw-bold">Ngày Bắt Đầu:</label>
                        <input type="date" name="thoigian_batdau" id="thoigian_batdau"
                               class="form-control bg-light @error('thoigian_batdau') is-invalid @enderror"
                               value="{{ old('thoigian_batdau') }}">
                        @error('thoigian_batdau')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="thoigian_ketthuc" class="form-label fw-bold">Ngày Kết Thúc:</label>
                        <input type="date" name="thoigian_ketthuc" id="thoigian_ketthuc"
                               class="form-control bg-light @error('thoigian_ketthuc') is-invalid @enderror"
                               value="{{ old('thoigian_ketthuc') }}">
                        @error('thoigian_ketthuc')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Bên phải -->
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="anh" class="form-label fw-bold">Ảnh Khóa Học</label>
                        <input type="file" class="form-control @error('anh') is-invalid @enderror"
                               name="anh" accept="image/*">
                        @error('anh')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Nút thao tác -->
            <div class="d-flex justify-content-center mt-4">
                <a href="{{ route('teacher.khoahoc') }}" class="btn btn-danger me-3 px-4">Hủy</a>
                <button type="submit" class="btn btn-success px-4">Thêm</button>
            </div>
        </form>

    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('courseForm').addEventListener('submit', function(e) {
        const ten = document.getElementById('ten-khoa-hoc').value.trim();
        const giangvien = document.getElementById('giang-vien').value.trim();
        const regex = /^[a-zA-Z0-9\sÀ-ỹ]{7,}$/;

        if (ten.length < 7 || ten.length > 155 || !regex.test(ten)) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Lỗi dữ liệu',
                text: 'Tên khóa học phải từ 7 đến 155 ký tự, không chứa ký tự đặc biệt.',
                confirmButtonText: 'OK'
            });
            return;
        }

        if (giangvien.length < 7 || giangvien.length > 55 || !regex.test(giangvien)) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Lỗi dữ liệu',
                text: 'Tên giảng viên phải từ 7 đến 55 ký tự, không chứa ký tự đặc biệt.',
                confirmButtonText: 'OK'
            });
            return;
        }

        const sobaihoc = document.getElementById('so-bai-hoc').value;
        if (sobaihoc < 1 || isNaN(sobaihoc)) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Lỗi dữ liệu',
                text: 'Số bài học phải là một số hợp lệ lớn hơn 0.',
                confirmButtonText: 'OK'
            });
            return;
        }

        const bd = document.getElementById('thoigian_batdau').value;
        const kt = document.getElementById('thoigian_ketthuc').value;
        if (bd && kt && bd > kt) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Lỗi thời gian',
                text: 'Ngày bắt đầu phải nhỏ hơn hoặc bằng ngày kết thúc.',
                confirmButtonText: 'OK'
            });
            return;
        }
    });
</script>
@endpush
@endsection

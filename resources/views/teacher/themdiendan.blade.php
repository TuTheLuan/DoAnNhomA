@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="bg-white p-4 rounded shadow-sm border">

        <!-- Tiêu đề -->
        <h2 class="text-center text-danger mb-4" style="text-shadow: 1px 1px #999;">
            Thêm Diễn Đàn
        </h2>

        <!-- Nội dung biểu mẫu -->
        <form>
            <div class="row">
                <!-- Bên trái -->
                <div class="col-md-4 text-center bg-light rounded p-4">
                    <i class="fas fa-image fa-3x mb-3 text-secondary"></i>
                    <div>
                        <a href="#" class="d-block text-primary fw-bold mb-2 text-decoration-underline">Tải tệp lên</a>
                        <p class="mb-0">Upload ảnh nền diễn đàn</p>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="ten-dien-dan" class="form-label fw-bold">Tên diễn đàn:</label>
                        <input type="text" id="ten-khoa-hoc" class="form-control bg-light" placeholder="Nhập tên diễn đàn">
                    </div>

                    <!-- Thêm radio button chọn chế độ -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">Chọn loại thảo luận:</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="visibility" id="public" value="public" checked>
                            <label class="form-check-label" for="public">
                                Công khai
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="visibility" id="anonymous" value="anonymous">
                            <label class="form-check-label" for="anonymous">
                                Ẩn danh
                            </label>
                        </div>
                    </div>

                    <!-- Thêm checkbox phòng họp -->
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="need_room" name="need_room">
                        <label class="form-check-label" for="need_room">Có phòng họp</label>
                    </div>

                    <!-- Thêm trường ngày tạo -->
                    <div class="mb-3">
                        <label for="ngay_tao" class="form-label fw-bold">Ngày tạo:</label>
                        <input type="date" id="ngay_tao" name="ngay_tao" class="form-control bg-light" 
                               value="{{ date('Y-m-d') }}" required>
                    </div>

                    <!-- Thêm combobox lớp học -->
                    <div class="mb-3">
                        <label for="lop_hoc" class="form-label fw-bold">Lớp học:</label>
                        <select id="lop_hoc" name="lop_hoc" class="form-select bg-light" required>
                            <!-- Nội dung -->
                        </select>
                    </div>
                </div>

                <!-- Bên phải -->
                <div class="col-md-4 text-center bg-light rounded p-4">
                    <i class="fas fa-image fa-3x mb-3 text-secondary"></i>
                    <div>
                        <a href="#" class="d-block text-primary fw-bold mb-2 text-decoration-underline">Tải tệp lên</a>
                        <p class="mb-0">Upload ảnh danh sách ảnh diễn đàn</p>
                    </div>
                </div>
            </div>

            <!-- Nút thao tác -->
            <div class="d-flex justify-content-center mt-4">
                <button type="button" class="btn btn-danger me-3 px-4">Hủy</button>
                <button type="submit" class="btn btn-success px-4">Thêm diễn đàn</button>
            </div>
        </form>

    </div>
</div>

<!-- Font Awesome -->
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/js/all.min.js" crossorigin="anonymous"></script>
@endpush
@endsection

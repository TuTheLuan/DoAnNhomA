@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h3><i class="bi bi-plus-circle"></i> Thêm Khóa học mới</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('teacher.luukhoahoc') }}">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="ma_khoa_hoc" class="form-label">Mã khóa học</label>
                        <input type="text" class="form-control" id="ma_khoa_hoc" name="ma_khoa_hoc" required>
                    </div>
                    <div class="col-md-6">
                        <label for="ten_khoa_hoc" class="form-label">Tên khóa học</label>
                        <input type="text" class="form-control" id="ten_khoa_hoc" name="ten_khoa_hoc" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="mo_ta" class="form-label">Mô tả</label>
                    <textarea class="form-control" id="mo_ta" name="mo_ta" rows="3"></textarea>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="hoc_ky" class="form-label">Tên giảng viên</label>
                        <select class="form-select" id="hoc_ky" name="hoc_ky">
                            <!-- Nội dung -->
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="trang_thai" class="form-label">Trạng thái</label>
                        <select class="form-select" id="trang_thai" name="trang_thai">
                            <option value="mo">Đang mở</option>
                            <option value="sap_mo">Sắp mở</option>
                        </select>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary me-2">Lưu lại</button>
                    <a href="{{ route('teacher.khoahoc') }}" class="btn btn-secondary">Hủy bỏ</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

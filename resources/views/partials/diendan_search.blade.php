<?php
// Lấy các giá trị từ request để giữ lại khi submit form
$ten_dien_dan = request('ten_dien_dan', '');
$ten_giang_vien = request('ten_giang_vien', '');
$loai_thao_luan = request('loai_thao_luan', '');
$ngay_tao_tu = request('ngay_tao_tu', '');
$ngay_tao_den = request('ngay_tao_den', '');
?>

<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0">Tìm kiếm diễn đàn</h5>
    </div>
    <div class="card-body">
        <form action="{{ $action }}" method="GET" class="row g-3">
            <div class="col-md-6">
                <label for="ten_dien_dan" class="form-label">Tên diễn đàn</label>
                <input type="text" class="form-control" id="ten_dien_dan" name="ten_dien_dan" 
                    value="{{ $ten_dien_dan }}" placeholder="Nhập tên diễn đàn...">
            </div>

            <div class="col-md-6">
                <label for="ten_giang_vien" class="form-label">Tên giảng viên</label>
                <input type="text" class="form-control" id="ten_giang_vien" name="ten_giang_vien" 
                    value="{{ $ten_giang_vien }}" placeholder="Nhập tên giảng viên...">
            </div>

            <div class="col-md-4">
                <label for="loai_thao_luan" class="form-label">Loại thảo luận</label>
                <select class="form-select" id="loai_thao_luan" name="loai_thao_luan">
                    <option value="">Tất cả</option>
                    <option value="public" {{ $loai_thao_luan == 'public' ? 'selected' : '' }}>Công khai</option>
                    <option value="anonymous" {{ $loai_thao_luan == 'anonymous' ? 'selected' : '' }}>Ẩn danh</option>
                </select>
            </div>

            <div class="col-md-4">
                <label for="ngay_tao_tu" class="form-label">Ngày tạo từ</label>
                <input type="date" class="form-control" id="ngay_tao_tu" name="ngay_tao_tu" 
                    value="{{ $ngay_tao_tu }}" max="{{ date('Y-m-d') }}">
            </div>

            <div class="col-md-4">
                <label for="ngay_tao_den" class="form-label">Ngày tạo đến</label>
                <input type="date" class="form-control" id="ngay_tao_den" name="ngay_tao_den" 
                    value="{{ $ngay_tao_den }}" max="{{ date('Y-m-d') }}">
            </div>

            <div class="col-12">
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i> Tìm kiếm
                    </button>
                    <a href="{{ $action }}" class="btn btn-secondary">
                        <i class="fas fa-undo"></i> Đặt lại
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Kiểm tra và giới hạn ngày tạo đến không được nhỏ hơn ngày tạo từ
    const ngayTaoTu = document.getElementById('ngay_tao_tu');
    const ngayTaoDen = document.getElementById('ngay_tao_den');

    ngayTaoTu.addEventListener('change', function() {
        ngayTaoDen.min = this.value;
    });

    ngayTaoDen.addEventListener('change', function() {
        ngayTaoTu.max = this.value;
    });
});
</script>
@endpush 
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Thêm diễn đàn mới</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('diendan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="ten_dien_dan" class="form-label">Tên diễn đàn <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('ten_dien_dan') is-invalid @enderror" 
                                id="ten_dien_dan" name="ten_dien_dan" value="{{ old('ten_dien_dan') }}" required>
                            @error('ten_dien_dan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="ten_giang_vien" class="form-label">Tên giảng viên <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('ten_giang_vien') is-invalid @enderror" 
                                id="ten_giang_vien" name="ten_giang_vien" value="{{ old('ten_giang_vien') }}" required>
                            @error('ten_giang_vien')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="loai_thao_luan" class="form-label">Loại thảo luận <span class="text-danger">*</span></label>
                            <select class="form-select @error('loai_thao_luan') is-invalid @enderror" 
                                id="loai_thao_luan" name="loai_thao_luan" required>
                                <option value="">Chọn loại thảo luận</option>
                                <option value="public" {{ old('loai_thao_luan') == 'public' ? 'selected' : '' }}>Công khai</option>
                                <option value="anonymous" {{ old('loai_thao_luan') == 'anonymous' ? 'selected' : '' }}>Ẩn danh</option>
                            </select>
                            @error('loai_thao_luan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="ngay_tao" class="form-label">Ngày tạo <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('ngay_tao') is-invalid @enderror" 
                                id="ngay_tao" name="ngay_tao" 
                                value="{{ old('ngay_tao', date('Y-m-d')) }}"
                                max="{{ date('Y-m-d') }}" 
                                required>
                            @error('ngay_tao')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="background_image" class="form-label">Ảnh nền <span class="text-danger">*</span></label>
                            <input type="file" class="form-control @error('background_image') is-invalid @enderror" 
                                id="background_image" name="background_image" accept="image/*" required>
                            @error('background_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="images" class="form-label">Ảnh đính kèm (tối đa 5 ảnh)</label>
                            <input type="file" class="form-control @error('images') is-invalid @enderror" 
                                id="images" name="images[]" accept="image/*" multiple>
                            @error('images')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Có thể chọn nhiều ảnh cùng lúc</small>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('diendan.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Quay lại
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Lưu diễn đàn
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Giới hạn số lượng file được chọn
    document.getElementById('images').addEventListener('change', function() {
        if (this.files.length > 5) {
            alert('Chỉ được chọn tối đa 5 ảnh');
            this.value = '';
        }
    });
});
</script>
@endpush

@endsection

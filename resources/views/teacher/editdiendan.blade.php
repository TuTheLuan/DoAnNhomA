@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow rounded">
                <div class="card-header bg-warning text-dark text-center fw-bold fs-4">
                    Chỉnh sửa Diễn Đàn
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Vui lòng kiểm tra lại dữ liệu nhập vào:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('diendan.update', $diendan->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            {{-- Ảnh nền --}}
                            <div class="col-md-4 text-center bg-light rounded p-4 mb-4 border">
                                <i class="fas fa-image fa-3x mb-3 text-secondary"></i>
                                <div>
                                    <label for="background_image" class="d-block text-primary fw-bold mb-2 text-decoration-underline">Chọn ảnh nền</label>
                                    <input type="file" id="background_image" name="background_image" class="form-control @error('background_image') is-invalid @enderror">
                                    @error('background_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <p class="mb-0 small text-muted">JPEG, PNG, JPG, GIF. Tối đa 2MB.</p>
                                </div>
                            </div>

                            {{-- Thông tin diễn đàn --}}
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="ma_dien_dan" class="form-label fw-bold">Mã diễn đàn:</label>
                                    <input type="text" id="ma_dien_dan" name="ma_dien_dan" class="form-control bg-white" 
                                           value="{{ $diendan->ma_dien_dan }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="ten-dien-dan" class="form-label fw-bold">Tên diễn đàn:</label>
                                    <input type="text" id="ten-dien-dan" name="ten_dien_dan"
                                           class="form-control bg-white @error('ten_dien_dan') is-invalid @enderror"
                                           value="{{ $diendan->ten_dien_dan }}" required>
                                    @error('ten_dien_dan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="ten_giang_vien" class="form-label fw-bold">Tên giảng viên:</label>
                                    <input type="text" id="ten_giang_vien" name="ten_giang_vien"
                                           class="form-control bg-white @error('ten_giang_vien') is-invalid @enderror"
                                           value="{{ $diendan->ten_giang_vien }}" required>
                                    @error('ten_giang_vien')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Loại thảo luận:</label>
                                    <div class="form-check">
                                        <input class="form-check-input @error('loai_thao_luan') is-invalid @enderror" type="radio" name="loai_thao_luan" id="public" value="public" {{ $diendan->loai_thao_luan == 'public' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="public">Công khai</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input @error('loai_thao_luan') is-invalid @enderror" type="radio" name="loai_thao_luan" id="anonymous" value="anonymous" {{ $diendan->loai_thao_luan == 'anonymous' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="anonymous">Ẩn danh</label>
                                    </div>
                                    @error('loai_thao_luan')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="ngay_tao" class="form-label fw-bold">Ngày tạo:</label>
                                    <input type="date" id="ngay_tao" name="ngay_tao" class="form-control bg-white" 
                                           value="{{ $diendan->ngay_tao }}" readonly>
                                </div>
                            </div>

                            {{-- Ảnh diễn đàn --}}
                            <div class="col-md-12 mt-4">
                                <div class="bg-light border rounded p-4 text-center">
                                    <i class="fas fa-image fa-2x mb-2 text-secondary"></i>
                                    <label for="images" class="d-block text-primary fw-bold mb-2 text-decoration-underline">Chọn ảnh diễn đàn</label>
                                    <input type="file" id="images" name="images[]" class="form-control @error('images.*') is-invalid @enderror" multiple>
                                    @error('images.*')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                    <p class="mb-0 small text-muted">Chọn nhiều ảnh (JPEG, PNG, JPG, GIF, max 2MB)</p>
                                </div>
                            </div>
                        </div>

                        {{-- Nút điều hướng --}}
                        <div class="text-center mt-4">
                            <a href="{{ route('diendan.index') }}" class="btn btn-secondary me-3 px-4">Hủy</a>
                            <button type="submit" class="btn btn-success px-4">Cập nhật</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/js/all.min.js" crossorigin="anonymous"></script>
@endpush
@endsection

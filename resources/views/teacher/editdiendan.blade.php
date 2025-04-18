@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="bg-white p-4 rounded shadow-sm border">
        <h2 class="text-center text-danger mb-4" style="text-shadow: 1px 1px #999;">
            Chỉnh sửa Diễn Đàn
        </h2>

        <form method="POST" action="{{ route('diendan.update', $diendan->id) }}">
            @csrf
            @method('PUT')
            <div class="row">
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
                        <input type="text" id="ten-dien-dan" name="ten_dien_dan" class="form-control bg-light" 
                               value="{{ $diendan->ten_dien_dan }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Chọn loại thảo luận:</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="loai_thao_luan" id="public" 
                                   value="public" {{ $diendan->loai_thao_luan == 'public' ? 'checked' : '' }}>
                            <label class="form-check-label" for="public">Công khai</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="loai_thao_luan" id="anonymous" 
                                   value="anonymous" {{ $diendan->loai_thao_luan == 'anonymous' ? 'checked' : '' }}>
                            <label class="form-check-label" for="anonymous">Ẩn danh</label>
                        </div>
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="co_phong_hop" name="co_phong_hop" 
                               {{ $diendan->co_phong_hop ? 'checked' : '' }}>
                        <label class="form-check-label" for="co_phong_hop">Có phòng họp</label>
                    </div>

                    <div class="mb-3">
                        <label for="user_id" class="form-label fw-bold">Học viên:</label>
                        <select id="user_id" name="user_id" class="form-select bg-light" required>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" 
                                    {{ $diendan->user_id == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Trạng thái:</label>
                        <select name="trang_thai" class="form-select bg-light" required>
                            <option value="active" {{ $diendan->trang_thai == 'active' ? 'selected' : '' }}>Hoạt động</option>
                            <option value="inactive" {{ $diendan->trang_thai == 'inactive' ? 'selected' : '' }}>Ngừng hoạt động</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-center mt-4">
                <a href="{{ route('diendan.index') }}" class="btn btn-danger me-3 px-4">Hủy</a>
                <button type="submit" class="btn btn-success px-4">Cập nhật</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/js/all.min.js" crossorigin="anonymous"></script>
@endpush
@endsection

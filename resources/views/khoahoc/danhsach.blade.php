@extends('layouts.app')

@section('content')
<div class="container bg-white p-4 rounded shadow-sm mt-4">

    <!-- Header -->
    <div class="d-flex align-items-center mb-4">
        <img src="https://cdn-icons-png.flaticon.com/512/147/147144.png" alt="avatar" style="width: 60px; height: 60px; border: 1px solid #999; border-radius: 5px;">
        <h1 class="ms-3 text-danger" style="text-shadow: 1px 1px #888;">KHÓA HỌC</h1>
    </div>
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Search Bar -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="flex-grow-1 me-2" style="max-width: 300px;">
            <input type="text" class="form-control" placeholder="Tìm kiếm khóa học...">
        </div>
        <div class="d-flex">

        <a href="{{ route('khoahoc.themkhoahoc') }}" class="btn btn-primary me-2">
        <i class="fas fa-plus"></i> THÊM MỚI</a>

            <button class="btn btn-secondary">
                <i class="fas fa-sync-alt"></i> TẢI LẠI DỮ LIỆU
            </button>
        </div>
    </div>

    <!-- Table -->
    <table class="table table-hover table-bordered">
        <thead class="table-light">
            <tr>
                <th><u>Mã Khóa Học</u></th>
                <th><u>Khóa Học</u></th>
                <th><u>Giảng Viên</u></th>
                <th><u>Số Bài Học</u></th>
                <th><u>Hình Ảnh</u></th>
                <th><u>Hành Động</u></th>
            </tr>
        </thead>
        <tbody>
        @foreach($khoahoctb as $khoahoc)
        <tr>
            <td>{{ $khoahoc->ma }}</td>
            <td>{{ $khoahoc->ten }}</td>
            <td>{{ $khoahoc->giangvien }}</td>
            <td>{{ $khoahoc->sobaihoc }}</td>
            <td>
                @if($khoahoc->anh)
                    <img src="{{ asset('images/' . $khoahoc->anh) }}" alt="Ảnh khóa học" width="80" height="60" style="object-fit: cover;">
                @else
                    <span class="text-muted">Không có ảnh</span>
                @endif
            </td>
            <td>
                <!-- Sửa -->
                <a href="{{ route('khoahoc.edit', $khoahoc->id) }}" title="Chỉnh sửa khóa học">
                    <i class="fas fa-pen text-primary me-3" style="cursor: pointer;"></i>
                </a>
                <!-- Xóa -->
                <form action="{{ route('khoahoc.destroy', $khoahoc->id) }}" method="POST" class="d-inline"
                    onsubmit="return confirm('Bạn có chắc chắn muốn xóa khóa học này?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn p-0" style="border: none; background: none;" title="Xóa khóa học">
                        <i class="fas fa-trash text-danger" style="cursor: pointer;"></i>
                    </button>
                </form>
            </td>
        </tr>
        @endforeach

        </tbody>
    </table>

    <!-- Pagination -->
    <div class="text-end">
        <span>1</span> of <span>2</span>
    </div>

</div>

<!-- Font Awesome -->
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/js/all.min.js" crossorigin="anonymous"></script>
@endpush
@endsection

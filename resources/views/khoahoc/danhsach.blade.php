@extends('layouts.app')

@section('content')
<div class="container bg-white p-4 rounded shadow-sm mt-4">

    <!-- Header -->
    <div class="d-flex align-items-center mb-4">
        <img src="https://cdn-icons-png.flaticon.com/512/147/147144.png" alt="avatar" style="width: 60px; height: 60px; border: 1px solid #999; border-radius: 5px;">
        <h1 class="ms-3 text-danger" style="text-shadow: 1px 1px #888;">HTBN</h1>
    </div>

    <!-- Search Bar -->
    <div class="d-flex justify-content-between mb-3">
        <input type="text" class="form-control me-2" placeholder="Search">
        <div>
            <button class="btn btn-primary me-2">
                <i class="fas fa-plus"></i> THÊM MỚI
            </button>
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
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>CNTT01</td>
                <td>Khóa học ngôn ngữ AI</td>
                <td></td>
                <td>
                    <i class="fas fa-pen text-dark me-2" style="cursor: pointer;"></i>
                    <i class="fas fa-trash text-danger" style="cursor: pointer;"></i>
                </td>
            </tr>
            <tr>
                <td>CNTT02</td>
                <td>Khóa học lập trình web</td>
                <td>Huỳnh Thái Quốc</td>
                <td>
                    <i class="fas fa-pen text-dark me-2" style="cursor: pointer;"></i>
                    <i class="fas fa-trash text-danger" style="cursor: pointer;"></i>
                </td>
            </tr>
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

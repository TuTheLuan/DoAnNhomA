@extends('layouts.app')

@section('content')
<style>
    .stat-box {
        text-align: center;
        padding: 20px;
        background-color: #e9f6ff;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .stat-box h1 {
        font-size: 40px;
        color: #2e58ff;
        margin: 0;
    }

    .stat-box p {
        margin: 0;
        font-size: 18px;
        color: #333;
    }

    .table-wrapper {
        overflow-x: auto;
    }

    .pagination-custom {
        display: flex;
        justify-content: center;
        margin-top: 15px;
    }

    .pagination-custom .page-link {
        border: none;
        margin: 0 5px;
        background-color: #f0f0f0;
        border-radius: 5px;
    }

    .left-sidebar {
        width: 200px;
        background-color: #f8f9fa;
        padding-top: 20px;
        height: 100vh;
        position: fixed;
        text-align: center;
    }

    .left-sidebar a {
        display: block;
        padding: 10px 0;
        color: #000;
        text-decoration: none;
        font-weight: bold;
    }

    .left-sidebar a:hover {
        background-color: #d0eaff;
    }

    .avatar {
        width: 60px;
        height: 60px;
        background-color: #ccc;
        border-radius: 50%;
        margin: auto;
    }

    .content-area {
        margin-left: 200px;
        padding: 20px;
    }
</style>

<div class="d-flex">
    <!-- Sidebar -->
    <div class="left-sidebar">
        <div class="avatar mb-2"></div>
        <p><strong>Admin 1</strong></p>
        <a href="#">Home</a>
        <a href="#">Học Viên</a>
        <a href="#">Khóa Học</a>
        <a href="#">Thống Kê</a>
        <a href="#">Đăng Xuất</a>
        <div class="mt-4">
            <img src="{{ asset('images/logo.png') }}" alt="logo" width="80">
        </div>
    </div>

    <!-- Nội dung chính -->
    <div class="content-area container-fluid">
        <h3 class="mb-4">THỐNG KÊ</h3>

        <div class="row text-center">
            <div class="col-md-4 stat-box">
                <h1>10</h1>
                <p>Tổng số học viên</p>
            </div>
            <div class="col-md-4 stat-box">
                <h1>20</h1>
                <p>Tổng số khoá học</p>
            </div>
            <div class="col-md-4 stat-box">
                <h1>100</h1>
                <p>Tổng số bài thi hoàn thành</p>
            </div>
        </div>

        <!-- Tìm kiếm và chọn khoá học -->
        <div class="d-flex align-items-center mt-4 mb-3">
            <input type="text" class="form-control me-2" placeholder="🔍" style="max-width: 200px;">
            <select class="form-select" style="max-width: 200px;">
                <option selected>Chọn khoá học</option>
                <option value="1">Khoá 1</option>
                <option value="2">Khoá 2</option>
            </select>
        </div>

        <!-- Bảng thống kê -->
        <div class="table-wrapper">
            <table class="table table-bordered text-center">
                <thead class="table-light">
                    <tr>
                        <th>STT</th>
                        <th>Mã học viên</th>
                        <th>Tên học viên</th>
                        <th>BH1</th>
                        <th>BH2</th>
                        <th>BH3</th>
                        <th>...</th>
                        <th>BH(n)</th>
                        <th>Điểm thi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td><td>001</td><td>Nguyễn Văn A</td><td>✔</td><td>✔</td><td>✔</td><td>...</td><td>✔</td><td>8.5</td>
                    </tr>
                    <tr>
                        <td>2</td><td>002</td><td>Trần Thị B</td><td>✔</td><td>✔</td><td>✔</td><td>...</td><td>✔</td><td>9.0</td>
                    </tr>
                    <tr>
                        <td>3</td><td>003</td><td>Lê Văn C</td><td>✔</td><td>✔</td><td>✔</td><td>...</td><td>✔</td><td>7.5</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Phân trang -->
        <div class="pagination-custom">
            <a class="page-link" href="#">«</a>
            <a class="page-link" href="#">‹</a>
            <span class="page-link">1</span>
            <a class="page-link" href="#">›</a>
            <a class="page-link" href="#">»</a>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mt-3">Quản Lý Học Viên</h2>

    <!-- Nút thêm và tìm kiếm -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <button class="btn btn-success">+ Thêm</button>
        <input type="text" id="search" class="form-control w-25" placeholder="🔍 Tìm kiếm...">
    </div>

    <!-- Bảng danh sách học viên -->
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Mã SV</th>
                <th>Họ Tên</th>
                <th>Giới Tính</th>
                <th>Email</th>
                <th>Địa Chỉ</th>
                <th>Trạng Thái</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
            <tr>
                <td>{{ $student->id }}</td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->gender }}</td>
                <td><a href="mailto:{{ $student->email }}">{{ $student->email }}</a></td>
                <td>{{ $student->address }}</td>
                <td>{{ $student->status ? '✔' : '❌' }}</td>
                <td>
                    <button class="btn btn-warning btn-sm">✏</button>
                    <button class="btn btn-danger btn-sm delete-btn" data-id="{{ $student->id }}">🗑</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Thanh phân trang -->
    <div class="pagination">
        {{ $students->links() }}
    </div>
</div>
@endsection

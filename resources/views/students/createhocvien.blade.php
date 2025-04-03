@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Thêm Học Viên Mới</h2>

        <form action="{{ route('students.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="ma_sv">Mã SV:</label>
                <input type="text" id="ma_sv" name="ma_sv" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="ho_ten">Họ Tên:</label>
                <input type="text" id="ho_ten" name="ho_ten" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="gioi_tinh">Giới Tính:</label>
                <select id="gioi_tinh" name="gioi_tinh" class="form-control" required>
                    <option value="Nam">Nam</option>
                    <option value="Nữ">Nữ</option>
                    <option value="Khác">Khác</option>
                </select>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="dia_chi">Địa Chỉ:</label>
                <input type="text" id="dia_chi" name="dia_chi" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="trang_thai">Trạng Thái:</label>
                <select id="trang_thai" name="trang_thai" class="form-control" required>
                    <option value="Đang học">Đang học</option>
                    <option value="Tốt nghiệp">Tốt nghiệp</option>
                    <option value="Tạm ngừng">Tạm ngừng</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Lưu</button>
        </form>
    </div>
@endsection

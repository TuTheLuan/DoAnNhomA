@extends('layouts.app')

@section('content')
<div class="container p-4 rounded" style="background-color: #e9f9fb; max-width: 500px;">
    <h3 class="text-center text-danger fw-bold mb-4">Cập Nhật Học Viên</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="update-form" action="{{ route('students.update', $student->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="ho_ten" class="form-label">Tên học viên</label>
            <input type="text" name="ho_ten" id="ho_ten" class="form-control" value="{{ $student->ho_ten }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Giới tính</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gioi_tinh" id="nam" value="Nam" {{ $student->gioi_tinh == 'Nam' ? 'checked' : '' }}>
                <label class="form-check-label" for="nam">Nam</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gioi_tinh" id="nu" value="Nữ" {{ $student->gioi_tinh == 'Nữ' ? 'checked' : '' }}>
                <label class="form-check-label" for="nu">Nữ</label>
            </div>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $student->email }}" required>
        </div>

        <div class="mb-3">
            <label for="dia_chi" class="form-label">Địa chỉ</label>
            <input type="text" name="dia_chi" id="dia_chi" class="form-control" value="{{ $student->dia_chi }}" required>
        </div>

        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-success px-4">Cập nhật</button>
            <a href="{{ route('students.index') }}" class="btn btn-danger px-4">Hủy</a>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const form = document.getElementById("update-form");
        form.addEventListener("submit", function (e) {
            e.preventDefault(); // Ngăn submit mặc định
            Swal.fire({
                title: "Xác nhận cập nhật",
                text: "Bạn có muốn cập nhật thông tin học viên không?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "OK",
                cancelButtonText: "Hủy"
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Nếu OK thì tiếp tục submit
                }
            });
        });
    });
</script>
@endsection

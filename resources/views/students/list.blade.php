@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mt-3">Quản Lý Học Viên</h2>

    <!-- Thanh tìm kiếm + nút thêm -->
    <div class="d-flex justify-content-end align-items-center mb-3">
    <a href="{{ route('students.create') }}" class="btn btn-success me-2">+ Thêm</a>

    <form method="GET" action="{{ route('students.index') }}" class="d-flex" style="max-width: 400px;">
    <input type="text" name="search" class="form-control me-2" placeholder="Tìm kiếm..." value="{{ request('search') }}" maxlength="100">
    <button type="submit" class="btn btn-outline-secondary">🔍</button>
    </form>

    </div>

        <!-- Table -->
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Họ tên</th>
                    <th>Giới tính</th>
                    <th>Email</th>
                    <th>Địa chỉ</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                <tr>
                    <td>{{ $student->id }}</td>
                    <td>{{ $student->ho_ten }}</td>
                    <td>{{ $student->gioi_tinh }}</td>
                    <td><a href="mailto:{{ $student->email }}">{{ $student->email }}</a></td>
                    <td>{{ $student->dia_chi }}</td>
                    <td>
                        <!-- Biểu tượng sửa -->
                        <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning btn-sm">✏</a>

                        <!-- Nút xóa học viên -->
                        <button class="btn btn-danger btn-sm delete-btn" data-id="{{ $student->id }}">🗑</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            <nav>
                <ul class="pagination">
                    {{-- << Trang đầu tiên --}}
                    <li class="page-item {{ $students->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $students->url(1) }}" aria-label="Đầu tiên">
                            <<
                        </a>
                    </li>

                    {{-- < Trang trước --}}
                    <li class="page-item {{ $students->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $students->previousPageUrl() }}" aria-label="Lùi">
                            <
                        </a>
                    </li>

                    {{-- Trang hiện tại --}}
                    <li class="page-item active">
                        <span class="page-link">
                            {{ $students->currentPage() }}
                        </span>
                    </li>

                    {{-- > Trang sau --}}
                    <li class="page-item {{ !$students->hasMorePages() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $students->nextPageUrl() }}" aria-label="Tiến">
                            >
                        </a>
                    </li>

                    {{-- >> Trang cuối --}}
                    <li class="page-item {{ !$students->hasMorePages() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $students->url($students->lastPage()) }}" aria-label="Cuối cùng">
                            >>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>


</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

    document.addEventListener("DOMContentLoaded", function () {
        const deleteButtons = document.querySelectorAll(".delete-btn");

        deleteButtons.forEach(button => {
            button.addEventListener("click", function () {
                const studentId = this.getAttribute("data-id");

                Swal.fire({
                    title: "Xác nhận xoá",
                    text: "Bạn có muốn xoá học viên này không?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Xoá",
                    cancelButtonText: "Hủy"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Tạo và gửi form xoá
                        const form = document.createElement("form");
                        form.method = "POST";
                        form.action = `/students/${studentId}`;

                        const csrf = document.createElement("input");
                        csrf.type = "hidden";
                        csrf.name = "_token";
                        csrf.value = "{{ csrf_token() }}";

                        const method = document.createElement("input");
                        method.type = "hidden";
                        method.name = "_method";
                        method.value = "DELETE";

                        form.appendChild(csrf);
                        form.appendChild(method);
                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            });
        });
    });


    // Xử lý sự kiện tìm kiếm
    document.addEventListener("DOMContentLoaded", function () {
    // Lắng nghe sự kiện khi người dùng nhập vào ô tìm kiếm
    document.querySelector("input[name='search']").addEventListener("input", function () {
        let searchTerm = this.value.toLowerCase(); // Lấy giá trị tìm kiếm và chuyển sang chữ thường

        // Lặp qua tất cả các hàng trong bảng
        document.querySelectorAll("tbody tr").forEach(function (row) {
            let studentName = row.querySelector("td:nth-child(2)").innerText.toLowerCase(); // Lấy tên học viên
            if (studentName.includes(searchTerm)) {
                row.style.display = ""; // Hiển thị dòng nếu tên học viên chứa từ khóa tìm kiếm
            } else {
                row.style.display = "none"; // Ẩn dòng nếu tên học viên không chứa từ khóa tìm kiếm
            }
        });
    });
});


</script>


@endsection

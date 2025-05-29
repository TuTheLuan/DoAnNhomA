@extends('layouts.app')

@section('content')
<div class="container bg-white p-4 rounded shadow-sm mt-4">
    <!-- Search and Actions -->
    <div class="d-flex justify-content-between align-items-center mb-3">

                <!-- Dropdown lọc giảng viên -->
        <form action="{{ route('teacher.khoahoc') }}" method="GET" class="mb-4" style="max-width: 600px;">
            <div class="input-group mb-2">
                <input type="text" name="search" class="form-control" placeholder="Tìm kiếm khóa học..." value="{{ request('search') }}">


                <select name="giangvien" class="form-select">
                    <option value="">-- Tất cả giảng viên --</option>
                    @foreach($tatcaGiangVien as $gv)
                        <option value="{{ $gv }}" {{ request('giangvien') == $gv ? 'selected' : '' }}>{{ $gv }}</option>
                    @endforeach
                </select>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i> Tìm kiếm
                </button>
            </div>
        </form>

        <div class="d-flex">

            <a href="{{ route('teacher.khoahoc.themkhoahoc') }}" class="btn btn-primary me-2">
                <i class="fas fa-plus"></i> THÊM MỚI
            </a>
            <a href="{{ route('teacher.khoahoc') }}" class="btn btn-secondary">
                <i class="fas fa-sync-alt"></i> TẢI LẠI DỮ LIỆU
            </a>
        </div>
    </div>

    <!-- Table -->
    <table class="table table-hover table-bordered align-middle">
        <thead class="table-light">
            <tr>
                <th><u>Mã Khóa Học</u></th>
                <th><u>Khóa Học</u></th>
                <th><u>Giảng Viên</u></th>
                <th><u>Số Bài Học</u></th>
                <th><u>Hình Ảnh</u></th>
                <th><u>Link Meet</u></th>
                <th><u>Thời Gian Meet</u></th>
                <th><u>Trạng Thái</u></th>
                <th><u>Ngày Bắt Đầu</u></th>
                <th><u>Ngày Kết Thúc</u></th>
                <th><u>Hành Động</u></th>
            </tr>
        </thead>
        <tbody>
            @foreach($khoahoctb as $khoahoc)
            <tr>
                <td>
                    <a href="{{ route('baihoc.danhsach', ['id' => $khoahoc->id]) }}" title="Xem bài học của {{ $khoahoc->ten }}">
                        {{ $khoahoc->ma }}
                    </a>
                </td>
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
                    @if($khoahoc->meet_link)
                        <a href="{{ $khoahoc->meet_link }}" target="_blank">Tham gia</a>
                    @else
                        <span class="text-muted">Không có link</span>
                    @endif
                </td>
                <td>{{ $khoahoc->meet_time ?? 'Chưa cập nhật' }}</td>
                <td>
                    @if($khoahoc->trangthai)
                        <span class="badge bg-info text-dark">{{ $khoahoc->trangthai }}</span>
                    @else
                        <span class="text-muted">Chưa có</span>
                    @endif
                </td>
                <td>
                    {{ $khoahoc->thoigian_batdau ? \Carbon\Carbon::parse($khoahoc->thoigian_batdau)->format('d/m/Y') : 'Chưa có' }}
                </td>
                <td>
                    {{ $khoahoc->thoigian_ketthuc ? \Carbon\Carbon::parse($khoahoc->thoigian_ketthuc)->format('d/m/Y') : 'Chưa có' }}
                </td>

                <td>
                    <div class="align-items-center">
                        <div class="d-flex align-items-center mb-2">
                            <!-- Biểu tượng sửa -->
                            <a href="{{ route('khoahoc.edit', $khoahoc->id) }}" title="Chỉnh sửa khóa học" class="me-2">
                                <i class="fas fa-pen text-primary" style="cursor: pointer;"></i>
                            </a>

                            <!-- Nút xóa khóa học (dùng SweetAlert2) -->
                            <button type="button"
                                class="btn p-0 btn-delete-khoahoc me-2"
                                style="border: none; background: none;"
                                data-id="{{ $khoahoc->id }}"
                                data-name="{{ $khoahoc->ten }}"
                                title="Xóa khóa học">
                                <i class="fas fa-trash text-danger" style="cursor: pointer;"></i>
                            </button>
                        </div>

                        <!-- Nút xem điểm - Nằm ngoài div con để xuống dòng -->
                        <a href="{{ route('diem.xem', $khoahoc->id) }}" class="btn btn-success btn-sm" title="Xem điểm khóa học">
                            <i class="fas fa-file-excel"></i> Điểm
                        </a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {!! $khoahoctb->withQueryString()->links('pagination::bootstrap-5') !!}
</div>


@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/js/all.min.js" crossorigin="anonymous"></script>
@endpush

@endsection

<!-- Modal xác nhận xóa -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form id="deleteForm" method="POST">
        @csrf
        @method('DELETE')
        <div class="modal-body text-center py-4">
            <div class="text-warning" style="font-size: 50px;"><i class="fas fa-exclamation-triangle"></i></div>
            <h5 class="mb-3">Xác nhận xóa</h5>
            <p>Bạn có muốn xóa khóa học <strong id="courseName"></strong> không?</p>
            <div class="d-flex justify-content-center mt-4">
                <button type="submit" class="btn btn-danger me-2">Xóa</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
            </div>
        </div>
      </form>
    </div>
  </div>
</div>


@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/js/all.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.btn-delete-khoahoc');
        const modalElement = document.getElementById('confirmDeleteModal');
        const courseNameSpan = document.getElementById('courseName');
        const deleteForm = document.getElementById('deleteForm');
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || document.querySelector('input[name="_token"]').value;

        if (modalElement) {
            const modal = new bootstrap.Modal(modalElement);
            let currentId = null;

            deleteButtons.forEach(button => {
                button.addEventListener('click', function () {
                    currentId = this.getAttribute('data-id');
                    const name = this.getAttribute('data-name');

                    courseNameSpan.textContent = name;
                    deleteForm.setAttribute('action', `/khoahoc/${currentId}`);
                    modal.show();
                });
            });

            deleteForm.addEventListener('submit', function (e) {
                e.preventDefault();

                fetch(deleteForm.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: '_method=DELETE'
                })
                .then(response => {
                    if (response.ok) {
                        modal.hide();
                        Swal.fire({
                            icon: 'success',
                            title: 'Đã xóa!',
                            text: 'Khóa học đã được xóa.',
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => {
                            // Xoá dòng khỏi bảng (xử lý DOM không cần reload toàn bộ)
                            const row = document.querySelector(`button[data-id="${currentId}"]`).closest('tr');
                            if (row) row.remove();
                        });
                    } else {
                        Swal.fire("Lỗi!", "Không thể xóa khóa học.", "error");
                    }
                })
                .catch(error => {
                    console.error(error);
                    Swal.fire("Lỗi!", "Đã xảy ra lỗi không mong muốn.", "error");
                });
            });
        }
    });
</script>
@endpush

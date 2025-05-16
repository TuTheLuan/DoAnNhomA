@extends('layouts.app')

@section('content')
<div class="container bg-white p-4 rounded shadow-sm mt-4">
    <!-- Search and Actions -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <form action="{{ route('khoahoc.index') }}" method="GET" class="mb-4" style="max-width: 600px;">
            <div class="input-group mb-2">
                <input type="text" name="search" class="form-control" placeholder="Tìm kiếm khóa học..." value="{{ request('search') }}">

                <!-- Dropdown lọc giảng viên -->
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
            <a href="{{ route('khoahoc.themkhoahoc') }}" class="btn btn-primary me-2">
                <i class="fas fa-plus"></i> THÊM MỚI
            </a>
            <a href="{{ route('khoahoc.index') }}" class="btn btn-secondary">
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
                <td>{{ $khoahoc->thoigian_batdau ? \Carbon\Carbon::parse($khoahoc->ngaybatdau)->format('d/m/Y') : 'Chưa có' }}</td>
                <td>{{ $khoahoc->thoigian_ketthuc ? \Carbon\Carbon::parse($khoahoc->ngayketthuc)->format('d/m/Y') : 'Chưa có' }}</td>
                <td>
                    <a href="{{ route('khoahoc.edit', $khoahoc->id) }}" title="Chỉnh sửa khóa học">
                        <i class="fas fa-pen text-primary me-3" style="cursor: pointer;"></i>
                    </a>

                    <form action="{{ route('khoahoc.destroy', $khoahoc->id) }}" method="POST" class="d-inline"
                        onsubmit="return confirm('Bạn có chắc chắn muốn xóa khóa học {{ $khoahoc->ten }}?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn p-0" style="border: none; background: none;" title="Xóa khóa học">
                            <i class="fas fa-trash text-danger" style="cursor: pointer;"></i>
                        </button>
                    </form>

                    <a href="{{ route('diem.xem', $khoahoc->id) }}" class="btn btn-success btn-sm ms-2" title="Xem điểm khóa học">
                        <i class="fas fa-file-excel"></i> Điểm
                    </a>
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

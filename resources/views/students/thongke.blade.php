@extends('layouts.app')

@section('content')
<div class="content flex-grow-1">
    <h2 class="mb-4">THỐNG KÊ</h2>

    <div class="row text-center mb-4">
        <div class="col-md-4">
            <div class="stat-box">
                <h1 class="text-primary">{{ $tongHocVien }}</h1>
                <p>Tổng số học viên</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-box">
                <h1 class="text-primary">{{ $tongKhoaHoc }}</h1>
                <p>Tổng số khóa học</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-box">
                <h1 class="text-primary">{{ $tongBaiThiHoanThanh }}</h1>
                <p>Tổng số bài thi hoàn thành</p>
            </div>
        </div>
    </div>

    <form method="GET" action="{{ route('students.thongke') }}" class="mb-3 d-flex justify-content-between">
        <div class="input-group w-50">
            <input type="text" name="search" class="form-control me-2" placeholder="Tìm kiếm học viên" value="{{ request('search') }}" maxlength="100">
            <button class="btn btn-outline-secondary" type="submit">
                🔍
            </button>
        </div>

        <select class="form-select w-25" name="khoahoc">
            <option value="">Chọn khóa học</option>
            @foreach ($khoahoc as $khoaHoc)
                <option value="{{ $khoaHoc->id }}" {{ request('khoahoc') == $khoaHoc->id ? 'selected' : '' }}>
                    {{ $khoaHoc->ten }}
                </option>
            @endforeach
        </select>


    </form>


    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>STT</th>
                    <th>Mã học viên</th>
                    <th>Tên học viên</th>
                    @for ($i = 1; $i <= 5; $i++)
                        <th>BH{{ $i }}</th>
                    @endfor
                    <th>Điểm thi</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($bangDiem as $index => $row)
            <tr>
                {{-- Tính số thứ tự chính xác theo trang --}}
                <td>{{ ($students->currentPage() - 1) * $students->perPage() + $index + 1 }}</td>
                <td>{{ $row['ma_hoc_vien'] }}</td>
                <td>{{ $row['ten'] }}</td>
                @for ($i = 1; $i <= 5; $i++)
                    <td>{{ $row['diem_bai_tap'][$i] ?? '' }}</td>
                @endfor
                <td>{{ $row['diem_thi'] ?? '' }}</td>
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
</div>
@endsection

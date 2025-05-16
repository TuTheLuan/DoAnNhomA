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

    <div class="mb-3 d-flex justify-content-between">
        <div class="input-group w-50">
            <input type="text" class="form-control" placeholder="Tìm kiếm khóa học">
            <button class="btn btn-outline-secondary" type="button">
                🔍
            </button>
        </div>
        <select class="form-select w-25">
            <option selected>Chọn khóa học</option>
            <!-- Thêm option khóa học ở đây -->
        </select>
    </div>

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
                    <td>{{ $index + 1 }}</td>
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

        <nav>
            <ul class="pagination">
                <li class="page-item disabled"><a class="page-link" href="#">«</a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">»</a></li>
            </ul>
        </nav>
    </div>
</div>
@endsection

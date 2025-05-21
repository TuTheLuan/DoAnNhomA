@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Điểm khóa học: {{ $khoahoc->ten ?? 'Khóa học demo' }}</h1>

     <div class="d-flex justify-content-between">
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Thoát</a>
        <a href="{{ route('diem.xuat', $khoahoc->id) }}" class="btn btn-success">Xuất file Excel</a>
        
    </div>

    <div class="mb-4">
        <h3>Điểm bài tập</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Mã học viên</th>
                    <th>Họ & Tên</th>
                    @for ($i = 1; $i <= 5; $i++)
                        <th>Bài tập {{ $i }}</th>
                    @endfor
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                <tr>
                    <td>{{ $student->ma_hoc_vien ?? 'HV' . $student->id }}</td>
                    <td>{{ $student->name ?? 'Học viên demo' }}</td>
                    @for ($i = 1; $i <= 5; $i++)
                        <td>{{ $diemBaiTap[$student->id][$i] ?? '' }}</td>
                    @endfor
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mb-4">
        <h3>Điểm thi</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Mã học viên</th>
                    <th>Họ & Tên</th>
                    <th>Điểm thi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                <tr>
                    <td>{{ $student->ma_hoc_vien ?? 'HV' . $student->id }}</td>
                    <td>{{ $student->name ?? 'Học viên demo' }}</td>
                    <td>{{ $diemThi[$student->id] ?? '' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

   
</div>
@endsection

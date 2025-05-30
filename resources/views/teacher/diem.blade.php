@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="text-center text-danger mb-4" style="text-shadow: 1px 1px 2px gray;">
        Danh Sách Học Viên - {{ $khoahoc->ten }}
    </h2>

    {{-- Hiển thị thông báo lỗi nếu có --}}
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    {{-- Nút Xuất Excel --}}
    @if (!$students->isEmpty())
        <div class="mb-3">
            <a href="{{ route('diem.xuat', $khoahoc->id) }}" class="btn btn-success">
                <i class="fas fa-file-excel"></i> Xuất Excel
            </a>
        </div>
    @endif

    @if ($students->isEmpty())
        <p>Chưa có học viên nào trong khóa học này.</p>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Tên Học Viên</th>
                        <th>Email</th>
                        {{-- Các cột điểm bài tập (nếu có) --}}
                        @php
                            $baiTapNumbers = [];
                            if (!empty($diemBaiTap)) {
                                foreach ($diemBaiTap as $studentScores) {
                                    $baiTapNumbers = array_merge($baiTapNumbers, array_keys($studentScores));
                                }
                                $baiTapNumbers = array_unique($baiTapNumbers);
                                sort($baiTapNumbers);
                            }
                        @endphp
                        @foreach($baiTapNumbers as $baiSo)
                            <th>Bài {{ $baiSo }}</th>
                        @endforeach
                        {{-- Cột điểm thi (nếu có) --}}
                        @if (!empty($diemThi))
                            <th>Điểm Thi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $index => $student)
                        <tr>
                            <td>{{ $students->firstItem() + $index }}</td>
                            <td>{{ $student->ho_ten }}</td>
                            <td>{{ $student->email }}</td>
                            {{-- Hiển thị điểm bài tập --}}
                            @foreach($baiTapNumbers as $baiSo)
                                <td>
                                    {{ $diemBaiTap[$student->id][$baiSo] ?? 'N/A' }}
                                </td>
                            @endforeach
                            {{-- Hiển thị điểm thi --}}
                            @if (!empty($diemThi))
                                <td>
                                    {{ $diemThi[$student->id] ?? 'N/A' }}
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Phân trang --}}
        <div class="d-flex justify-content-center mt-4">
            {{ $students->links() }}
        </div>

    @endif

</div>
@endsection 
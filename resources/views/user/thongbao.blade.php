@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3>Danh sách tất cả thông báo</h3>
    <ul class="list-group">
        @forelse($thongBaoMoiNhat as $thongBao)
            <li class="list-group-item">
                <strong>{{ $thongBao->tieu_de }}</strong>
                <br>
                <small>{{ $thongBao->ngay_tao ? \Carbon\Carbon::parse($thongBao->ngay_tao)->format('d/m/Y') : '' }}</small>
                <p>{{ $thongBao->noi_dung }}</p>
            </li>
        @empty
            <li class="list-group-item">Không có thông báo nào.</li>
        @endforelse
    </ul>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="text-center py-3 mb-4 bg-danger text-white rounded">
                <h1>Đăng Xuất</h1>
            </div>

            <div class="alert alert-info text-center" role="alert">
                Bạn đã đăng xuất thành công.
            </div>

            <div class="text-center">
                <a href="{{ route('login') }}" class="btn btn-primary">Đăng nhập lại</a>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.auth')

@section('title', 'Quên Mật Khẩu')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="bg-warning text-white p-3 text-center rounded">
                <h4>Quên Mật Khẩu</h4>
            </div>

            <form method="POST" action="{{ route('password.email') }}" class="mt-4">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Nhập email của bạn</label>
                    <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
                    @error('email') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                </div>
                <button type="submit" class="btn btn-warning w-100">Gửi mã xác nhận</button>
            </form>
        </div>
    </div>
</div>
@endsection

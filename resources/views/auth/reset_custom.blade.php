@extends('layouts.auth')

@section('title', 'Đặt Lại Mật Khẩu')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="bg-success text-white p-3 text-center rounded">
                <h4>Đặt lại mật khẩu</h4>
            </div>

            <form method="POST" action="{{ route('password.update.custom') }}" class="mt-4">
                @csrf
                <div class="mb-3">
                    <label for="password" class="form-label">Mật khẩu mới</label>
                    <input type="password" name="password" class="form-control" required>
                    @error('password') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Xác nhận mật khẩu</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-success w-100">Cập nhật</button>
            </form>
        </div>
    </div>
</div>
@endsection

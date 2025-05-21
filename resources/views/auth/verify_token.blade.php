@extends('layouts.auth')

@section('title', 'Xác Minh Mã')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="bg-primary text-white p-3 text-center rounded">
                <h4>Nhập mã xác nhận</h4>
                <p>Mã đã được gửi đến email của bạn</p>
            </div>

            <form method="POST" action="{{ url('/password/verify') }}" class="mt-4">
                @csrf
                <div class="mb-3">
                    <label for="token" class="form-label">Mã xác nhận</label>
                    <input type="text" name="token" class="form-control" required>
                    @error('token') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                </div>
                <button type="submit" class="btn btn-primary w-100">Xác minh</button>
            </form>
        </div>
    </div>
</div>
@endsection

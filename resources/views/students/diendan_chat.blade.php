@extends('layouts.app')

@section('content')
    <div class="container py-4">
        {{-- Phần trên cùng --}}
        <div class="container mb-4 border-bottom pb-3">
            <div class="row justify-content-center align-items-center g-4">
                {{-- Bên trái: Ảnh --}}
                <div class="col-md-5 text-center">
                    <div id="visible-images" class="d-flex flex-wrap justify-content-center gap-2 mb-2">
                        @if(!empty($diendan->images))
                            @foreach(array_slice($diendan->images, 0, 2) as $image)
                                <img src="{{ asset('storage/' . $image) }}" alt="Ảnh diễn đàn" class="rounded shadow-sm border"
                                    style="width: 120px; height: 120px; object-fit: cover;">
                            @endforeach
                        @else
                            <span class="text-muted">Chưa có ảnh</span>
                        @endif
                    </div>

                    @php
                        $hiddenImages = array_slice($diendan->images ?? [], 2);
                    @endphp

                    @if(count($hiddenImages) > 0)
                        <div id="more-images" class="d-none flex-wrap justify-content-center gap-2 mt-2">
                            @foreach($hiddenImages as $image)
                                <img src="{{ asset('storage/' . $image) }}" alt="Ảnh diễn đàn" class="rounded shadow-sm border"
                                    style="width: 70px; height: auto; max-height: 100px; object-fit: cover;">
                            @endforeach
                        </div>
                        <button id="toggle-more" class="btn btn-sm btn-outline-primary mt-2">
                            Xem thêm ({{ count($hiddenImages) }})
                        </button>
                    @endif
                </div>

                {{-- Bên phải: Thông tin --}}
                <div class="col-md-6 text-center text-md-start">
                    <h2 class="fw-bold text-primary mb-3" style="font-size: 2rem;">{{ $diendan->ten_dien_dan }}</h2>
                    <p class="mb-2 text-secondary">👨‍🏫 Giảng viên: <strong>{{ $diendan->ten_giang_vien }}</strong></p>
                    <p class="mb-0 text-secondary">📅 Ngày tạo:
                        {{ \Carbon\Carbon::parse($diendan->ngay_tao)->format('d/m/Y') }}</p>
                </div>
            </div>
        </div>


        {{-- Khung chat --}}
        <div id="chat-box" class="border rounded shadow-sm p-3 mb-4"
            style="height: 400px; overflow-y: auto; background-color: #f9f9f9;">
            @if(isset($messages) && count($messages) > 0)
                @foreach($messages as $message)
                    <div class="mb-3">
                        <div class="fw-semibold text-dark">{{ $message->student_name ?? 'Học viên' }}</div>
                        <div class="text-body">{{ $message->content }}</div>
                        <div class="text-muted small">{{ \Carbon\Carbon::parse($message->created_at)->format('H:i d/m/Y') }}</div>
                    </div>
                @endforeach
            @else
                <div class="text-center text-muted">Chưa có tin nhắn nào</div>
            @endif
        </div>

        {{-- Nơi nhập chat --}}
        <form id="chat-form" method="POST" action="{{ route('diendan.chat.send', $diendan->id) }}">
            @csrf
            <div class="input-group shadow-sm">
                <input type="text" name="message" class="form-control" placeholder="Nhập tin nhắn..." required>
                <button class="btn btn-primary px-4" type="submit">Gửi</button>
            </div>
        </form>
    </div>

    {{-- JavaScript cho nút "Xem thêm" --}}
    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const btn = document.getElementById('toggle-more');
                const moreImages = document.getElementById('more-images');

                if (btn) {
                    btn.addEventListener('click', function () {
                        moreImages.classList.toggle('d-none');
                        btn.style.display = 'none'; // Ẩn nút sau khi hiển thị
                    });
                }
            });
        </script>
    @endpush
@endsection
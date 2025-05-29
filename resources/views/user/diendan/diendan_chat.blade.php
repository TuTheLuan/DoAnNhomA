@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                {{-- Thông tin diễn đàn --}}
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h2 class="fw-bold text-primary mb-3">{{ $diendan->ten_dien_dan }}</h2>
                                <p class="mb-2 text-secondary">👨‍🏫 Giảng viên: <strong>{{ $diendan->ten_giang_vien }}</strong></p>
                                <p class="mb-3 text-secondary">📅 Ngày tạo:
                                    {{ \Carbon\Carbon::parse($diendan->ngay_tao)->format('d/m/Y') }}
                                </p>

                                @if(!empty($diendan->valid_images))
                                    <div class="mb-4">
                                        <h5 class="text-muted mb-3">📎 Ảnh đính kèm:</h5>
                                        <div class="row g-3">
                                            @php
                                                $maxVisibleImages = 3; // Số ảnh tối đa hiển thị
                                                $totalImages = count($diendan->valid_images);
                                                $remainingImages = $totalImages - $maxVisibleImages;
                                            @endphp
                                            
                                            @foreach($diendan->valid_images as $index => $image)
                                                @if($index < $maxVisibleImages)
                                                    <div class="col-4">
                                                        <div class="position-relative">
                                                            <a href="{{ asset('storage/' . $image) }}" 
                                                                target="_blank" 
                                                                class="d-block image-link">
                                                                <img src="{{ asset('storage/' . $image) }}" 
                                                                    alt="Ảnh đính kèm" 
                                                                    class="img-fluid rounded shadow-sm"
                                                                    style="width: 100%; height: 200px; object-fit: cover;"
                                                                    loading="lazy"
                                                                    onerror="this.style.display='none'">
                                                                
                                                                @if($index == ($maxVisibleImages - 1) && $remainingImages > 0)
                                                                    <div class="position-absolute top-0 end-0 bg-dark bg-opacity-75 text-white rounded-end px-2 py-1">
                                                                        +{{ $remainingImages }}
                                                                    </div>
                                                                @endif
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Khung chat --}}
                <div id="chat-box" class="border rounded shadow-sm p-3 mb-4"
                    style="height: 400px; overflow-y: auto; background-color: #f9f9f9;">
                    @if(isset($messages) && count($messages) > 0)
                        @foreach($messages as $message)
                            <div class="mb-3">
                                <div class="fw-semibold text-dark">
                                @if($isTeacher)
                                    {{ $message->student_name }}
                                @else
                                    {{ \App\Helpers\ForumHelper::getAnonymousName($message->student_name) }}
                                @endif
                                </div>
                                <div class="text-body">{{ $message->content }}</div>
                                <div class="text-muted small">{{ \Carbon\Carbon::parse($message->created_at)->format('H:i d/m/Y') }}</div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center text-muted py-3">
                            <p class="mb-0">Chưa có tin nhắn nào. Hãy là người đầu tiên gửi tin nhắn!</p>
                        </div>
                    @endif
                </div>

                {{-- Form gửi tin nhắn --}}
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('diendan.chat.store', $diendan->id) }}" method="POST" class="mb-0">
                            @csrf
                            <div class="form-group">
                                <label for="content" class="form-label">Tin nhắn của bạn</label>
                                <textarea class="form-control @error('content') is-invalid @enderror" 
                                    id="content" name="content" rows="3" 
                                    placeholder="Nhập nội dung tin nhắn..."></textarea>
                                @error('content')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-paper-plane"></i> Gửi tin nhắn
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Cuộn xuống cuối khung chat
        var chatBox = document.getElementById('chat-box');
        chatBox.scrollTop = chatBox.scrollHeight;

        // Thêm lightbox cho ảnh (nếu cần)
        var imageLinks = document.querySelectorAll('.image-link');
        imageLinks.forEach(function(link) {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                window.open(this.href, '_blank', 'width=800,height=600');
            });
        });
    });
    </script>
    @endpush
@endsection
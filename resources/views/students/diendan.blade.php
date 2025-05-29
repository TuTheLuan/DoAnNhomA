@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="mb-4">
                <h2>Diễn đàn thảo luận</h2>
                <p class="text-muted">Tham gia thảo luận và trao đổi với giảng viên và các bạn học viên khác.</p>
            </div>

            @include('partials.diendan_search', ['action' => route('diendan.index.students')])

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="row">
                @forelse($diendans as $diendan)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100">
                            @if($diendan->background_image)
                                <div class="card-img-top position-relative" style="height: 200px;">
                                    <img src="{{ asset('storage/' . $diendan->background_image) }}" 
                                        class="w-100 h-100" alt="Ảnh nền diễn đàn"
                                        style="object-fit: cover;"
                                        loading="lazy"
                                        onerror="this.style.display='none'">
                                </div>
                            @else
                                <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                    <i class="fas fa-image fa-3x text-muted"></i>
                                </div>
                            @endif
                            
                            <div class="card-body">
                                <h5 class="card-title">{{ $diendan->ten_dien_dan }}</h5>
                                
                                @if(!empty($diendan->valid_images))
                                    <div class="mb-3">
                                        <p class="text-muted mb-2">
                                            Ảnh đính kèm 
                                            <span class="badge bg-secondary">{{ count($diendan->valid_images) }}</span>
                                        </p>
                                        <div class="d-flex flex-wrap gap-2">
                                            @foreach($diendan->valid_images as $index => $image)
                                                @if($index < 4)
                                                    <div class="position-relative" style="width: 60px; height: 60px;">
                                                        <img src="{{ asset('storage/' . $image) }}" 
                                                            alt="Ảnh đính kèm" 
                                                            class="img-thumbnail w-100 h-100"
                                                            style="object-fit: cover;"
                                                            loading="lazy"
                                                            onerror="this.style.display='none'">
                                                    </div>
                                                @endif
                                            @endforeach
                                            @if(count($diendan->valid_images) > 4)
                                                <div class="position-relative d-flex align-items-center justify-content-center bg-secondary text-white" 
                                                    style="width: 60px; height: 60px; border-radius: 0.25rem;">
                                                    +{{ count($diendan->valid_images) - 4 }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endif

                                <p class="card-text">
                                    <small class="text-muted">
                                        <i class="fas fa-user"></i> {{ $diendan->ten_giang_vien }}
                                    </small>
                                </p>
                                <p class="card-text">
                                    <span class="badge bg-{{ $diendan->loai_thao_luan == 'public' ? 'success' : 'warning' }}">
                                        {{ $diendan->loai_thao_luan == 'public' ? 'Công khai' : 'Ẩn danh' }}
                                    </span>
                                </p>
                                <p class="card-text">
                                    <small class="text-muted">
                                        <i class="fas fa-calendar"></i> {{ $diendan->ngay_tao->format('d/m/Y') }}
                                    </small>
                                </p>
                            </div>
                            <div class="card-footer bg-transparent">
                                <a href="{{ route('diendan.chat', $diendan->id) }}" class="btn btn-primary w-100">
                                    <i class="fas fa-comments"></i> Tham gia thảo luận
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            Không có diễn đàn nào.
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="d-flex justify-content-center my-3">
                {{ $diendans->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection

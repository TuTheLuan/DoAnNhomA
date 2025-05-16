@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">
    <header class="d-flex align-items-center p-3 border-bottom bg-white">
        <div class="container d-flex justify-content-between align-items-center">
            <a href="/" class="d-flex align-items-center text-decoration-none">
                <img src="{{ asset('images/logo.jpg') }}" alt="Logo" style="height: 50px;">
            </a>
<form class="d-flex" role="search" action="{{ url('/khoahoc/danhsach') }}" method="GET">
    <input class="form-control me-2" type="search" placeholder="Tìm kiếm khóa học" aria-label="Search" name="search">
    <button class="btn btn-outline-primary" type="submit"><i class="bi bi-search"></i></button>
</form>
            <nav>
                <ul class="nav">
                    <li class="nav-item"><a href="#" class="nav-link">Giới thiệu</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Giáo viên</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Phòng luyện</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">iChat - Hỏi đáp với AI</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Hướng nghiệp</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Thư viện</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Hướng dẫn Đăng ký học</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Hỗ trợ</a></li>
                </ul>
            </nav>
            <div>
                <a href="#" class="btn btn-outline-secondary me-2">Đăng Nhập</a>
                <a href="#" class="btn btn-warning">Đăng Ký</a>
            </div>
        </div>
    </header>

    <div class="bg-secondary text-white text-center py-2">
        <span>🔥 Dành cho học sinh lớp 6-11 Bứt phá 9+ sau 3 tháng hè. 100 suất giảm tới 60% học phí => <a href="#" class="text-warning fw-bold">ĐĂNG KÝ NGAY</a></span>
    </div>

    <main class="container mt-4">
        <div class="row">
            <aside class="col-md-3">
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
                        <i class="bi bi-list"></i> Các khóa học
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">Đại học - Cao đẳng</a>
                    <a href="#" class="list-group-item list-group-item-action">Bổ trợ Phương pháp - Kĩ năng</a>
                    <a href="#" class="list-group-item list-group-item-action">Bồi dưỡng học sinh giỏi</a>
                    <a href="#" class="list-group-item list-group-item-action">LUYỆN THI ĐẠI HỌC</a>
                    <a href="#" class="list-group-item list-group-item-action">Lớp 10 - Lớp 11 - Lớp 12</a>
                    <a href="#" class="list-group-item list-group-item-action">Luyện thi vào 10</a>
                    <a href="#" class="list-group-item list-group-item-action">Lớp 6 - Lớp 7 - Lớp 8 - Lớp 9</a>
                    <a href="#" class="list-group-item list-group-item-action">Lớp 1 - Lớp 2 - Lớp 3 - Lớp 4 - Lớp 5</a>
                    <a href="#" class="list-group-item list-group-item-action">Tiền tiểu học</a>
                </div>
            </aside>
            <section class="col-md-6">
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4" aria-label="Slide 5"></button>
                    </div>
                    <div class="carousel-inner rounded">
                        <div class="carousel-item active">
                            <img src="{{ asset('images/1746110748_tải xuống.png') }}" class="d-block w-100" alt="Slide 1">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/slide2.jpg') }}" class="d-block w-100" alt="Slide 2">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/slide3.jpg') }}" class="d-block w-100" alt="Slide 3">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/slide4.jpg') }}" class="d-block w-100" alt="Slide 4">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/slide5.jpg') }}" class="d-block w-100" alt="Slide 5">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </section>
            <aside class="col-md-3">
                <div class="card mb-3">
                    <img src="{{ asset('images/1746110748_tải xuống.png') }}" class="card-img-top" alt="Banner 1">
                </div>
                <div class="card">
                    <img src="{{ asset('images/1746110748_tải xuống.png') }}" class="card-img-top" alt="Banner 2">
                </div>
            </aside>
        </div>

        <div class="bg-primary text-white text-center py-3 mt-4 rounded">
            <div class="container d-flex justify-content-around">
                <div>
                    <h5>18 năm</h5>
                    <p>Giáo dục trực tuyến</p>
                </div>
                <div>
                    <h5>7.461.878</h5>
                    <p>Thành viên</p>
                </div>
                <div>
                    <h5>Nền tảng học trực tuyến số 1 Việt Nam</h5>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection

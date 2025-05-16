<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Trang chủ - Học trực tuyến</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #e3f2fd; /* màu xanh nhạt primary */
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #1c7ed6;
            padding: 1rem 2rem;
            color: white;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        header .logo {
            font-weight: 700;
            font-size: 1.75rem;
        }
        nav a {
            color: white;
            margin-right: 1rem;
            text-decoration: none;
            font-weight: 500;
        }
        nav a:hover {
            text-decoration: underline;
        }
        .search-bar {
            max-width: 400px;
        }
        .hero {
            background: url('https://img-c.udemycdn.com/notices/web_carousel_slide/image/8f1a3a0a-0a0a-4a3a-9a3a-0a0a0a0a0a0a.jpg') center center/cover no-repeat;
            height: 400px;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 0 2rem;
            text-shadow: 0 0 10px rgba(0,0,0,0.7);
        }
        .hero h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }
        .hero p {
            font-size: 1.25rem;
            margin-bottom: 2rem;
        }
        .hero form {
            max-width: 600px;
        }
        .section-title {
            font-size: 1.75rem;
            font-weight: 700;
            margin: 2rem 0 1rem 0;
            color: #212529;
        }
        .course-card {
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 4px 12px rgb(0 0 0 / 0.15);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }
        .course-card:hover {
            transform: translateY(-5px);
        }
        .course-card img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }
        .course-card-body {
            padding: 1rem;
        }
        .course-title {
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
            color: #1c7ed6;
        }
        .course-instructor {
            font-size: 0.9rem;
            color: #6c757d;
            margin-bottom: 0.5rem;
        }
        .course-rating {
            color: #f59f00;
            font-weight: 600;
        }
        .container-custom {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }
        footer {
            background-color: #1c7ed6;
            color: white;
            text-align: center;
            padding: 1rem 0;
            margin-top: 3rem;
        }
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2rem;
            }
            .hero p {
                font-size: 1rem;
            }
            .course-card img {
                height: 120px;
            }
        }
    </style>
</head>
<body>
    <header class="d-flex justify-content-between align-items-center">
        <div class="logo">
            <img src="{{ asset('images/logo.jpg') }}" alt="Logo Online Learning" style="height: 100px; object-fit: contain;" />
        </div>
        <form class="d-flex search-bar" role="search" action="{{ url('/khoahoc/danhsach') }}" method="GET">
            <input class="form-control me-2" type="search" placeholder="Tìm kiếm khóa học" aria-label="Search" name="search" />
            <button class="btn btn-light" type="submit">Tìm</button>
        </form>
        <nav>
            <a href="#">Giới thiệu</a>
            <a href="#">Giáo viên</a>
            <a href="#">Phòng luyện</a>
            <a href="#">iChat - Hỏi đáp với AI</a>
            <a href="#">Hướng nghiệp</a>
            <a href="#">Thư viện</a>
        </nav>
        <div>
            <a href="{{ route('login') }}" class="btn btn-light me-2">Đăng Nhập</a>
            <a href="{{ route('register') }}" class="btn btn-warning">Đăng Ký</a>
        </div>
    </header>
    <section class="hero">
        <h1>Học trực tuyến mọi lúc mọi nơi</h1>
        <p>Khám phá hàng ngàn khóa học chất lượng cao từ các giảng viên hàng đầu</p>
        <form class="d-flex" role="search" action="{{ url('/khoahoc/danhsach') }}" method="GET">
            <input class="form-control me-2" type="search" placeholder="Tìm kiếm khóa học" aria-label="Search" name="search" />
            <button class="btn btn-primary" type="submit">Tìm kiếm</button>
        </form>
    </section>
    <main class="container-custom">
        <h2 class="section-title">Khóa học nổi bật</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="course-card" onclick="location.href='#'">
                    <img src="{{ asset('images/course1.jpg') }}" alt="Khóa học 1" />
                    <div class="course-card-body">
                        <div class="course-title">Lập trình PHP cơ bản</div>
                        <div class="course-instructor">Giảng viên: Huỳnh Thái Quốc</div>
                        <div class="course-rating">★★★★☆ (4.5)</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="course-card" onclick="location.href='#'">
                    <img src="{{ asset('images/course2.jpg') }}" alt="Khóa học 2" />
                    <div class="course-card-body">
                        <div class="course-title">Tiếng Anh giao tiếp cơ bản</div>
                        <div class="course-instructor">Giảng viên: Huỳnh Thái Quốc</div>
                        <div class="course-rating">★★★★☆ (4.3)</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="course-card" onclick="location.href='#'">
                    <img src="{{ asset('images/course3.jpg') }}" alt="Khóa học 3" />
                    <div class="course-card-body">
                        <div class="course-title">Toán rời rạc</div>
                        <div class="course-instructor">Giảng viên: Huỳnh Thái Quốc</div>
                        <div class="course-rating">★★★★★ (4.8)</div>
                    </div>
                </div>
            </div>
        </div>
        <h2 class="section-title">Danh mục khóa học</h2>
        <div class="row g-3">
            <div class="col-6 col-md-3">
                <a href="#" class="d-block text-center text-decoration-none text-dark">
                    <img src="{{ asset('images/category1.jpg') }}" alt="Lập trình" class="img-fluid rounded mb-2" />
                    <div>Lập trình</div>
                </a>
            </div>
            <div class="col-6 col-md-3">
                <a href="#" class="d-block text-center text-decoration-none text-dark">
                    <img src="{{ asset('images/category2.jpg') }}" alt="Ngoại ngữ" class="img-fluid rounded mb-2" />
                    <div>Ngoại ngữ</div>
                </a>
            </div>
            <div class="col-6 col-md-3">
                <a href="#" class="d-block text-center text-decoration-none text-dark">
                    <img src="{{ asset('images/category3.jpg') }}" alt="Kỹ năng mềm" class="img-fluid rounded mb-2" />
                    <div>Kỹ năng mềm</div>
                </a>
            </div>
            <div class="col-6 col-md-3">
                <a href="#" class="d-block text-center text-decoration-none text-dark">
                    <img src="{{ asset('images/category4.jpg') }}" alt="Thi cử" class="img-fluid rounded mb-2" />
                    <div>Thi cử</div>
                </a>
            </div>
        </div>
    </main>
    <footer>
        &copy; 2025 Online Learning. Laravel
    </footer>
</body>
</html>

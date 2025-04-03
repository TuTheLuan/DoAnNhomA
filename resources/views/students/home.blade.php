<?php
include 'db.php';

// Số bản ghi trên mỗi trang
$limit = 5; 
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Truy vấn danh sách học viên với phân trang
$sql = "SELECT * FROM hocvien LIMIT $start, $limit";
$result = $conn->query($sql);

// Đếm tổng số bản ghi
$total_results = $conn->query("SELECT COUNT(id) AS total FROM hocvien")->fetch_assoc()['total'];
$total_pages = ceil($total_results / $limit);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Học Viên</title>
    <link rel="stylesheet" href="css/app.css">


</style>
</head>
<body>
    <div class="wrapper">
        <!-- SIDEBAR -->
        <div class="sidebar">
            <div class="admin">
            <img src="{{ url('/assets/admin_icon.png') }}" alt="Admin">
                <p>Admin 1</p>
            </div>
            <ul>
                <li><a href="#">🏠 Home</a></li>
                <li><a href="#" class="active">📋 Học Viên</a></li>
                <li><a href="#">📚 Khóa Học</a></li>
                <li><a href="#">📊 Thống Kê</a></li>
                <li><a href="#">🚪 Đăng Xuất</a></li>
            </ul>
        </div>

        <!-- MAIN CONTENT -->
        <div class="main-content">
            <h2>QUẢN LÝ HỌC VIÊN</h2>
            <div class="top-bar">
                <a href="add.php" class="btn-add">+ Thêm</a>
                <input type="text" placeholder="Tìm kiếm...">
                <button class="btn-search">🔍</button>
            </div>
            <table>
                <tr>
                    <th>Mã SV</th>
                    <th>Họ Tên</th>
                    <th>Giới tính</th>
                    <th>Email</th>
                    <th>Địa chỉ</th>
                    <th>Trạng thái</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= $row["ma_sv"] ?></td>
                    <td><?= $row["ho_ten"] ?></td>
                    <td><?= $row["gioi_tinh"] == "Nam" ? "Nam" : "Nữ" ?></td>
                    <td><?= $row["email"] ?></td>
                    <td><?= $row["dia_chi"] ?></td>
                    <td>
                        <a href="edit.php?id=<?= $row['id'] ?>">✏️</a>
                        <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Xóa học viên này?')">🗑️</a>
                    </td>
                </tr>
                <?php } ?>
            </table>

            <!-- PHÂN TRANG -->
            <div class="pagination">
                <a href="?page=1">««</a>
                <a href="?page=<?= max(1, $page - 1) ?>">«</a>
                <span><?= $page ?></span>
                <a href="?page=<?= min($total_pages, $page + 1) ?>">»</a>
                <a href="?page=<?= $total_pages ?>">»»</a>
            </div>
        </div>
    </div>
</body>
</html>

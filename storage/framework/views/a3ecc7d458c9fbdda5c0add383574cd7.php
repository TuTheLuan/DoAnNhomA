<?php $__env->startSection('content'); ?>
<div class="container">
    <h2 class="mt-3">Quản Lý Học Viên</h2>

    <!-- Thanh tìm kiếm + nút thêm -->
    <div class="d-flex justify-content-end align-items-center mb-3">
    <a href="<?php echo e(route('students.create')); ?>" class="btn btn-success me-2">+ Thêm</a>

    <form method="GET" action="<?php echo e(route('students.index')); ?>" class="d-flex" style="max-width: 400px;">
    <input type="text" name="search" class="form-control me-2" placeholder="Tìm kiếm..." value="<?php echo e(request('search')); ?>" maxlength="100">
    <button type="submit" class="btn btn-outline-secondary">🔍</button>
    </form>

    </div>

        <!-- Table -->
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Họ tên</th>
                    <th>Giới tính</th>
                    <th>Email</th>
                    <th>Địa chỉ</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($student->id); ?></td>
                    <td><?php echo e($student->ho_ten); ?></td>
                    <td><?php echo e($student->gioi_tinh); ?></td>
                    <td><a href="mailto:<?php echo e($student->email); ?>"><?php echo e($student->email); ?></a></td>
                    <td><?php echo e($student->dia_chi); ?></td>
                    <td>
                        <!-- Biểu tượng sửa -->
                        <a href="<?php echo e(route('students.edit', $student->id)); ?>" class="btn btn-warning btn-sm">✏</a>

                        <!-- Nút xóa học viên -->
                        <button class="btn btn-danger btn-sm delete-btn" data-id="<?php echo e($student->id); ?>">🗑</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            <nav>
                <ul class="pagination">
                    
                    <li class="page-item <?php echo e($students->onFirstPage() ? 'disabled' : ''); ?>">
                        <a class="page-link" href="<?php echo e($students->url(1)); ?>" aria-label="Đầu tiên">
                            <<
                        </a>
                    </li>

                    
                    <li class="page-item <?php echo e($students->onFirstPage() ? 'disabled' : ''); ?>">
                        <a class="page-link" href="<?php echo e($students->previousPageUrl()); ?>" aria-label="Lùi">
                            <
                        </a>
                    </li>

                    
                    <li class="page-item active">
                        <span class="page-link">
                            <?php echo e($students->currentPage()); ?>

                        </span>
                    </li>

                    
                    <li class="page-item <?php echo e(!$students->hasMorePages() ? 'disabled' : ''); ?>">
                        <a class="page-link" href="<?php echo e($students->nextPageUrl()); ?>" aria-label="Tiến">
                            >
                        </a>
                    </li>

                    
                    <li class="page-item <?php echo e(!$students->hasMorePages() ? 'disabled' : ''); ?>">
                        <a class="page-link" href="<?php echo e($students->url($students->lastPage())); ?>" aria-label="Cuối cùng">
                            >>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>


</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const deleteForms = document.querySelectorAll(".delete-form");

        deleteForms.forEach(function (form) {
            form.addEventListener("submit", function (e) {
                e.preventDefault(); // Ngăn submit mặc định
                Swal.fire({
                    title: "Bạn có chắc chắn?",
                    text: "Hành động này sẽ xóa học viên khỏi danh sách!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Xóa",
                    cancelButtonText: "Hủy"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // Nếu xác nhận thì submit form
                    }
                });
            });
        });
    });

    document.addEventListener("DOMContentLoaded", function () {
        const deleteButtons = document.querySelectorAll(".delete-btn");

        deleteButtons.forEach(button => {
            button.addEventListener("click", function () {
                const studentId = this.getAttribute("data-id");

                Swal.fire({
                    title: "Xác nhận xoá",
                    text: "Bạn có muốn xoá học viên này không?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Xoá",
                    cancelButtonText: "Hủy"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Tạo và gửi form xoá
                        const form = document.createElement("form");
                        form.method = "POST";
                        form.action = `/students/${studentId}`;

                        const csrf = document.createElement("input");
                        csrf.type = "hidden";
                        csrf.name = "_token";
                        csrf.value = "<?php echo e(csrf_token()); ?>";

                        const method = document.createElement("input");
                        method.type = "hidden";
                        method.name = "_method";
                        method.value = "DELETE";

                        form.appendChild(csrf);
                        form.appendChild(method);
                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            });
        });
    });


    // Xử lý sự kiện tìm kiếm
    document.addEventListener("DOMContentLoaded", function () {
    // Lắng nghe sự kiện khi người dùng nhập vào ô tìm kiếm
    document.querySelector("input[name='search']").addEventListener("input", function () {
        let searchTerm = this.value.toLowerCase(); // Lấy giá trị tìm kiếm và chuyển sang chữ thường

        // Lặp qua tất cả các hàng trong bảng
        document.querySelectorAll("tbody tr").forEach(function (row) {
            let studentName = row.querySelector("td:nth-child(2)").innerText.toLowerCase(); // Lấy tên học viên
            if (studentName.includes(searchTerm)) {
                row.style.display = ""; // Hiển thị dòng nếu tên học viên chứa từ khóa tìm kiếm
            } else {
                row.style.display = "none"; // Ẩn dòng nếu tên học viên không chứa từ khóa tìm kiếm
            }
        });
    });
});


</script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\DoAnNhomA\resources\views/students/list.blade.php ENDPATH**/ ?>
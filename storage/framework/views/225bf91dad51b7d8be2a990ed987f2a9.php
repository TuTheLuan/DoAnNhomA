<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h1>Chào mừng bạn đến với Hệ thống Học Trực Tuyến</h1>
    <div class="row">
        <!-- Khóa học hiện tại -->
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">Khóa học của tôi</h5>
                </div>
                <!-- Nội dung -->
                <div class="card-footer text-center">
                    <a href="#" class="btn btn-outline-primary">Xem tất cả khóa học</a>
                </div>
            </div>
        </div>

        <!-- Hoạt động gần đây -->
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-header bg-info text-white">
                    <h5 class="card-title mb-0">Hoạt động gần đây</h5>
                </div>
                <!-- Nội dung -->
                <div class="card-footer text-center">
                    <a href="#" class="btn btn-outline-info">Xem tất cả hoạt động</a>
                </div>
            </div>
        </div>

        <!-- Thông báo & Deadline -->
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-header bg-warning text-dark">
                    <h5 class="card-title mb-0">Thông báo</h5>
                </div>
                
                <!-- Nội dung -->
                <div class="card-footer text-center">
                    <a href="#" class="btn btn-outline-warning">Xem tất cả thông báo</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\DoAnNhomA\resources\views/students/home.blade.php ENDPATH**/ ?>
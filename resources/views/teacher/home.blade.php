@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">

        <div class="col-md-9">
            <!-- Main content -->
            <div class="card">
                <div class="card-header">
                    <h4>Thông tin các khoá học</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="card text-white bg-success">
                                <div class="card-body">
                                    <h5 class="card-title">Số khóa học</h5>
                                    <!-- Nội dung -->
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card text-white bg-info">
                                <div class="card-body">
                                    <h5 class="card-title">Số lớp học</h5>
                                    <!-- Nội dung -->
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card text-white bg-warning">
                                <div class="card-body">
                                    <h5 class="card-title">Học viên</h5>
                                    <!-- Nội dung -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <h5>Thông báo mới nhất</h5>
                        <ul class="list-group">
                            <!-- Nội dung -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<?php $this->layout('layout-admin', ['filter_result' => $filter_result]); ?>
<?php $this->start('page-css'); ?>
<link rel="stylesheet" href="/css/admin.css">
<link rel="stylesheet" href="/css/student_manage.css">
<?php $this->stop(); ?>
<?php $this->start("page-content"); ?>
<div class="container">
    <form action="/filter_student" class="d-flex flex-column align-items-center">
        <div class="row col-5 d-flex flex-row m-2">
            <div class="col" style="text-align: right;">
                <label for="student_id">Mã sinh viên</label>
            </div>
            <div class="col-8">
                <input type="text" name="student_id" id="student_id" class="mssv" placeholder="Nhập mã sinh viên">
            </div>
        </div>
        <div class="row col-5 d-flex flex-row m-2">
            <div class="col" style="text-align: right;">
                <label for="student_name">Tên sinh viên</label>
            </div>
            <div class="col-8">
                <input type="text" name="student_name" id="student_name" class="mssv" placeholder="Nhập tên sinh viên">
            </div>
        </div>
        <div class="row col-5 d-flex flex-row m-2">
            <div class="col" style="text-align: right;">
                <label for="student_line">Số dòng</label>
            </div>
            <div class="col-8">
                <select name="student_line" id="student_line">
                    <option value="">Chọn số dòng</option>
                    <option value="1">5</option>
                    <option value="2">10</option>
                    <option value="3">15</option>
                    <option value="4">20</option>
                    <option value="5">25</option>
                </select>
            </div>
        </div>
        <input type="submit" value="Tìm kiếm" class="btn btn-primary">
    </form>
</div>
<div class="container">
    <div class="result"></div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">MSSV</th>
                <th scope="col">Họ tên</th>
                <th scope="col">Giới tính</th>
                <th scope="col">Số điện thoại</th>
                <th scope="col">Mã phòng</th>
                <th scope="col">Hành động</th>
            </tr>
        </thead>
        <tbody>
            <!-- Example row, replace with dynamic data -->
            <!-- <tr>
                <td>01</td>
                <td>B004</td>
                <td>1</td>
                <td>4</td>
                <td>2</td>
                <td>Trống</td>
                <td>
                    <a href="/edit_room/1" class="btn btn-warning">Xem thành viên</a>
                    <a href="/delete_room/1" class="btn btn-danger">Giải phóng</a>
                </td>
            </tr> -->
        </tbody>
</div>
<?php $this->stop(); ?>
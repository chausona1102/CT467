<?php $this->layout('layout-admin', ['filter_result' => $filter_result]); ?>
<?php $this->start('page-css'); ?>
<link rel="stylesheet" href="/css/admin.css">
<link rel="stylesheet" href="/css/room_manage.css">
<?php $this->stop(); ?>
<?php $this->start("page-content"); ?>
<div class="container">
    <form action="/filter_function" class="d-flex flex-column align-items-center">
        <div class="row col-5 d-flex flex-row m-2">
            <div class="col" style="text-align: right;">
                <label for="codeRoom">Mã phòng</label>
            </div>
            <div class="col-8">
                <select name="codeRoom" id="codeRoom">
                    <option value="">Chọn mã phòng</option>
                    <option value="B00401">B00401</option>
                    <option value="B00402">B00402</option>
                    <option value="B00403">B00403</option>
                    <option value="G00404">G00404</option>  
                    <option value="G00405">G00405</option>
                    <option value="G00406">G00406</option>
                    <option value="G00407">G00407</option>
                    <option value="G00408">G00408</option>
                    ...
                </select>
            </div>
        </div>
        <div class="row col-5 d-flex flex-row m-2">
            <div class="col" style="text-align: right;">
                <label for="category">Loại phòng</label>
            </div>
            <div class="col-8">
                <select name="category" id="category">
                    <option value="">Chọn loại phòng</option>
                    <option value="1">Nam</option>
                    <option value="0">Nữ</option>
                </select>
            </div>
        </div>
        <div class="row col-5 d-flex flex-row m-2">
            <div class="col" style="text-align: right;">
                <label for="status">Tình trạng phòng</label>
            </div>
            <div class="col-8">
                <select name="status" id="status">
                    <option value="">Chọn tình trạng phòng</option>
                    <option value="1">Trống</option>
                    <option value="0">Đầy</option>
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
                <th scope="col">Mã phòng</th>
                <th scope="col">Mã loại phòng</th>
                <th scope="col">Số phòng</th>
                <th scope="col">Số lượng tối đa</th>
                <th scope="col">Số lượng hiện tại</th>
                <th scope="col">Tình trạng phòng</th>
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
<?php $this->layout('layout-admin'); ?>
<?php $this->start('page-css'); ?>
<link rel="stylesheet" href="/css/admin.css">
<link rel="stylesheet" href="/css/room_manage.css">
<?php $this->stop(); ?>
<?php $this->start("page-content"); ?>
<div class="container">
    <form action="" class="d-flex flex-column align-items-center">
        <div class="row col-5 d-flex flex-row m-2">
            <div class="col" style="text-align: right;">
                <label for="codeRow">Mã dãy</label>
            </div>
            <div class="col-8">
                <select name="codeRow" id="codeRow">
                    <option value="">Chọn dãy</option>
                    <option value="A">Dãy A</option>
                    <option value="B">Dãy B</option>
                    <option value="C">Dãy C</option>
                    <option value="C">Dãy D</option>
                </select>
            </div>
        </div>
        <div class="row col-5 d-flex flex-row m-2">
            <div class="col" style="text-align: right;">
                <label for="codeRoom">Mã phòng</label>
            </div>
            <div class="col-8">
                <select name="codeRoom" id="codeRoom">
                    <option value="">Chọn phòng</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
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
                    <option value="1">Nữ</option>
                    <option value="2">Nam</option>
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
                <th scope="col">Mã dãy</th>
                <th scope="col">Mã phòng</th>
                <th scope="col">Loại phòng</th>
                <th scope="col">Số lượng sinh viên</th>
                <th scope="col">Hành động</th>
            </tr>
        </thead>
        <tbody>
            <!-- Example row, replace with dynamic data -->
            <tr>
                <td>A</td>
                <td>1</td>
                <td>Nữ</td>
                <td>3</td>
                <td>
                    <a href="/edit_room/1" class="btn btn-warning">Xem thành viên</a>
                    <a href="/delete_room/1" class="btn btn-danger">Giải phóng</a>
                </td>
            </tr>
        </tbody>
</div>
<?php $this->stop(); ?>
<?php $this->layout('layout-admin', ['roomsL10' => $roomsL10 , 'filter_result' => $filter_result]); ?>
<?php $this->start('page-css'); ?>
<link rel="stylesheet" href="/css/admin.css">
<link rel="stylesheet" href="/css/room_manage.css">
<?php $this->stop(); ?>
<?php $this->start("page-content"); ?>
<div class="container">
    <form action="/filter_function" class="d-flex flex-column align-items-center">
        <div class="row col-5 d-flex flex-row m-2">
            <div class="col" style="text-align: right;">
                <label for="member">Loại phòng</label>
            </div>
            <div class="col-8">
                <select name="member" id="member" class="col-5">
                    <option value="">Tất cả</option>
                    <option value="2">2 người</option>
                    <option value="4">4 người</option>
                    <option value="8">8 người</option>
                </select>
            </div>
        </div>
        <div class="row col-5 d-flex flex-row m-2">
            <div class="col" style="text-align: right;">
                <label for="sex">Giới tính</label>
            </div>
            <div class="col-8">
                <select name="sex" id="sex" class="col-5">
                    <option value="">Tất cả</option>
                    <option value="nam">Nam</option>
                    <option value="nữ">Nữ</option>
                </select>
            </div>
        </div>
        <div class="row col-5 d-flex flex-row m-2">
            <div class="col" style="text-align: right;">
                <label for="status">Tình trạng phòng</label>
            </div>
            <div class="col-8">
                <select name="status" id="status" class="col-5">
                    <option value="">Tất cả</option>
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
                <th scope="col">Loại phòng</th>
                <th scope="col">Tình trạng phòng</th>
                <th scope="col">Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                if(isset($filter_result)) {
                    if(!empty($filter_result)) {
                        foreach ($filter_result as $row) {
                            $tinhtrang = $row['TinhTrang'] ? 'Trống' : 'Đầy';
                            echo "
                                <tr>
                                    <td>{$row['MaPhong']}</td>
                                    <td>{$row['MaLoaiPhong']}</td>
                                    <td>{$row['SoPhong']}</td>
                                    <td>{$row['SoLuongToiDa']}</td>
                                    <td>{$row['SoLuongHienTai']}</td>
                                    <td>{$row['GioiTinh']}</td>
                                    <td>{$tinhtrang}</td>
                                    <td>
                                        <a href=\"/edit_room/1\" class=\"btn btn-warning\">Xem thành viên</a>
                                        <a href=\"/delete_room/1\" class=\"btn btn-danger\">Giải phóng</a>
                                    </td>
                                </tr>
                            ";
                        }
                    } else {
                        echo "
                                <h3>
                                    Không tìm thấy kết quả
                                </h3>
                        ";
                    }
                }else if(isset($roomsL10)) {
                    foreach ($roomsL10 as $room) {
                        echo "
                            <tr>
                                <td>{$room['MaPhong']}</td>
                                <td>{$room['MaLoaiPhong']}</td>
                                <td>{$room['SoPhong']}</td>
                                <td>{$room['SoLuongToiDa']}</td>
                                <td>{$room['SoLuongHienTai']}</td>
                                <td>{$room['GioiTinh']}</td>
                                <td>{$room['TinhTrang']}</td>
                                <td>
                                    <a href=\"/edit_room/1\" class=\"btn btn-warning\">Xem thành viên</a>
                                    <a href=\"/delete_room/1\" class=\"btn btn-danger\">Giải phóng</a>
                                </td>
                            </tr>
                        ";
                    }
                }
            ?>
        </tbody>
        </table>
</div>
<?php $this->stop(); ?>
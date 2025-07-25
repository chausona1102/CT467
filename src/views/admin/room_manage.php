<?php $this->layout('layout-admin', ['roomsL10' => $roomsL10, 'filter_result' => $filter_result, 'roomID' => $maphong, 'memberRoom' => $memberRoom]); ?>
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
<div id="print_f" class="d-flex flex-row justify-content-end px-4 mx-5">
    <button id="exportExcelRoom" class="btn btn-success" onclick="export_excel_room()">Xuất Excel</button>
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
            if (isset($filter_result)) {
                if (!empty($filter_result)) {
                    foreach ($filter_result as $row) {
                        $tinhtrang = $row['TinhTrang'] ? 'Trống' : 'Đầy';
                        $maphong = $row['MaPhong'];
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
                                        <form method='post' action='/api/phong/sinhvien/'>
                                            <input type='hidden' name='MaPhong' value='$maphong'></input>
                                            <button type='submit' class='btn btn-warning'>Xem thành viên</button>
                                        </form>
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
            } else if (isset($roomsL10)) {
                foreach ($roomsL10 as $room) {
                    $tinhtrang = $room['TinhTrang'] ? 'Trống' : 'Đầy';
                    $maphong = $room['MaPhong'];
                    echo "
                            <tr>
                                <td>{$room['MaPhong']}</td>
                                <td>{$room['MaLoaiPhong']}</td>
                                <td>{$room['SoPhong']}</td>
                                <td>{$room['SoLuongToiDa']}</td>
                                <td>{$room['SoLuongHienTai']}</td>
                                <td>{$room['GioiTinh']}</td>
                                <td>{$tinhtrang}</td>
                                <td>
                                    <form method='post' action='/api/phong/sinhvien/'>
                                        <input type='hidden' name='MaPhong' value='$maphong'></input>
                                        <button type='submit' class='btn btn-warning'>Xem thành viên</button>
                                    </form>
                                </td>
                            </tr>
                        ";
                }
            }
            ?>
        </tbody>
    </table>
</div>
<?php 
    if(isset($memberRoom) && !empty($memberRoom)) {
        echo "
            <div class='modal' id='showModal' tabindex='1040' aria-labelledby='exampleModalLabel'>
                <div class='modal-dialog p-2 border border-info rounded' style='background-color: #fff'>
                    <h5 class='modal-title text-center'>Thông tin phòng $roomID</h5>
                    <div class='modal-body'>
                        <table class='table table-striped'>
                        <thead>
                            <tr>
                                <th scope='col'>Mã sinh viên</th>
                                <th scope='col'>Họ Tên</th>
                                <th scope='col'>Giới tính</th>
                                <th scope='col'>Số điện thoại</th>
                            </tr>
                        </thead>
                        <tbody>
        ";
        foreach ($memberRoom as $row) {
            echo "
            <tr>
                            <td>{$row['MaSV']}</td>
                            <td>{$row['HoTen']}</td>
                            <td>{$row['GioiTinh']}</td>
                            <td>{$row['SoDienThoai']}</td>
            </tr>
            ";
        }
        echo "
                        </tbody>
                        </table>
                        <div class='d-flex justify-content-end'>
                            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Đóng</button>
                        </div>

                    </div>
                </div>
            </div>
        ";
    }
?>
<script src="/js/printf.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Nếu modal tồn tại thì dùng Bootstrap để show nó
        const modalElement = document.getElementById('showModal');
        if (modalElement) {
            const modal = new bootstrap.Modal(modalElement);
            modal.show();
        }
    });
</script>

<?php $this->stop(); ?>
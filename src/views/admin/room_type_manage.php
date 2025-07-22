<?php $this->layout('layout-admin', ['roomTypes' => $roomTypes, 'result' => $result]); ?>
<?php $this->start('page-css'); ?>
<link rel="stylesheet" href="/css/admin.css">
<link rel="stylesheet" href="/css/room_manage.css">
<?php $this->stop(); ?>
<?php $this->start("page-content"); ?>
<div class="container">
    <form action="/filter_room_type" class="d-flex flex-column align-items-center">
        <div class="row col-5 d-flex flex-row m-2">
            <div class="col" style="text-align: right;">
                <label for="codeRoom">Mã phòng</label>
            </div>
            <div class="col-8">
                <select name="codeRoom" id="codeRoom" class="col-6">
                    <option value="">Tất cả</option>
                    <?php
                    if (isset($roomTypes)) {
                        foreach ($roomTypes as $roomType) {
                            echo "<option value=\"{$roomType['MaLoaiPhong']}\">{$roomType['MaLoaiPhong']}</option>";
                        }
                    }
                    ?>
                </select>
            </div>
        </div>
        <input type="submit" value="Tìm kiếm" class="btn btn-primary">
    </form>
</div>
<div class="container">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Mã loại phòng</th>
                <th scope="col">Tên loại phòng</th>
                <th scope="col">Giá Thuê</th>
                <th scope="col">Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($result)) {
                foreach ($result as $row) {
                    echo "<tr>
                        <td>{$row['MaLoaiPhong']}</td>
                        <td>{$row['TenLoaiPhong']}</td>
                        <td>{$row['GiaThue']}</td>
                        <td>
                            <a href=\"#\" 
                            class=\"btn btn-warning btn-edit\" 
                            data-id=\"{$row['MaLoaiPhong']}\"
                            data-ten=\"" . htmlspecialchars($row['TenLoaiPhong'], ENT_QUOTES) . "\"
                            data-gia=\"{$row['GiaThue']}\"
                            data-bs-toggle=\"modal\" 
                            data-bs-target=\"#editRoomTypeModal\">
                            Sửa
                            </a>
                            <a href=\"#\" 
                            class=\"btn btn-danger\"
                            data-id=\"{$row['MaLoaiPhong']}\"
                            data-bs-toggle=\"modal\" 
                            data-bs-target=\"#delRoomTypeModal\">
                            Xóa
                            </a>
                        </td>
                    </tr>";
                }
            }else if (isset($roomTypes) && !empty($roomTypes)) {
                foreach ($roomTypes as $roomType) {
                    echo "<tr>
                        <td>{$roomType['MaLoaiPhong']}</td>
                        <td>{$roomType['TenLoaiPhong']}</td>
                        <td>{$roomType['GiaThue']}</td>
                        <td>
                            <a href=\"#\" 
                            class=\"btn btn-warning btn-edit\" 
                            data-id=\"{$roomType['MaLoaiPhong']}\"
                            data-ten=\"" . htmlspecialchars($roomType['TenLoaiPhong'], ENT_QUOTES) . "\"
                            data-gia=\"{$roomType['GiaThue']}\"
                            data-bs-toggle=\"modal\" 
                            data-bs-target=\"#editRoomTypeModal\">
                            Sửa
                            </a>
                            <a href=\"#\" 
                            class=\"btn btn-danger\"
                            data-id=\"{$roomType['MaLoaiPhong']}\"
                            data-bs-toggle=\"modal\" 
                            data-bs-target=\"#delRoomTypeModal\">
                            Xóa
                            </a>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='4' class='text-center'>Không có loại phòng nào.</td></tr>";
            }
            ?>
        </tbody>
        <!-- Modal edit-->
        <div class="modal fade" id="editRoomTypeModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <form method="POST" action="/room_type_manage/edit">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Sửa loại phòng</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="MaLoaiPhong" id="edit-id">
                            <div class="mb-3">
                                <label for="edit-ten" class="form-label">Mã loại phòng</label>
                                <input type="text" name="MaLoaiPhongMoi" id="edit-ma" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="edit-ten" class="form-label">Tên loại phòng</label>
                                <input type="text" name="TenLoaiPhong" id="edit-ten" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="edit-gia" class="form-label">Giá thuê</label>
                                <input type="number" name="GiaThue" id="edit-gia" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                            <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>   
          <!-- Modal ADD  -->
           <div class="modal fade" id="addRoomTypeModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <form method="POST" action="/room_type_manage/add">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Thêm loại phòng</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="edit-ten" class="form-label">Mã loại phòng</label>
                                <input type="text" name="MaLoaiPhong" id="edit-ten" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="edit-ten" class="form-label">Tên loại phòng</label>
                                <input type="text" name="TenLoaiPhong" id="edit-ten" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="edit-gia" class="form-label">Giá thuê</label>
                                <input type="number" name="GiaThue" id="edit-gia" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                            <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>   
        <div class="modal fade" id="delRoomTypeModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <form method="POST" action="/room_type_manage/delete">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Xoá loại phòng</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label id="del-label" class="form-label">Chắc chắn xóa mã loại phòng </label>
                                <input type="hidden" name="MaLoaiPhong" id="del-id">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                            <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>   
</div>
<a href="#" 
    class="btn btn-primary"
    data-bs-toggle=modal
    data-bs-target=#addRoomTypeModal
    > Thêm</a>
    <script src="/js/roomtype.js"></script>
<?php $this->stop(); ?>
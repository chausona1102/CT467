<?php $this->layout('layout-admin', ['filter_result' => $filter_result, 'students' => $students]); ?>
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
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="20">20</option>
                    <option value="25">25</option>
                </select>
            </div>
        </div>
        <input type="submit" value="Tìm kiếm" class="btn btn-primary">
    </form>
</div>
<div id="print_f" class="d-flex flex-row justify-content-end px-4 mx-5">
    <button id="exportExcelStudent" class="btn btn-success" onclick="export_excel_student()">Xuất excel</button>
</div>
<div class="container">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">MSSV</th>
                <th scope="col">Họ tên</th>
                <th scope="col">Giới tính</th>
                <th scope="col">Số điện thoại</th>
                <!-- <th scope="col">Mã phòng</th> -->
                <th scope="col">Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                // print_r($students);
                if(isset($filter_result) && !empty($filter_result)) {
                    // print_r($filter_result);
                    foreach ($filter_result as $row) {
                        echo "
                        <tr>
                            <td>{$row['MaSV']}</td>
                            <td>{$row['HoTen']}</td>
                            <td>{$row['GioiTinh']}</td>
                            <td>{$row['SoDienThoai']}</td>
                            <td>
                                <a href=\"/#\" class=\"btn btn-warning\"
                                data-id=\"{$row['MaSV']}\"
                                data-name=\"{$row['HoTen']}\"
                                data-sex=\"{$row['GioiTinh']}\"
                                data-phone=\"{$row['SoDienThoai']}\"
                                data-bs-toggle=modal
                                data-bs-target=#editModal
                                >
                                Sửa
                                </a>
                                <a href=\"/#\" class=\"btn btn-danger\"
                                data-id=\"{$row['MaSV']}\"
                                data-bs-toggle=modal
                                data-bs-target=#delModal
                                >
                                Xóa
                                </a>
                            </td>
                        </tr>
                        ";
                    }
                }else if (isset($students) && !empty($students)){
                    foreach ($students as $row) {
                        echo "
                        <tr>
                            <td>{$row['MaSV']}</td>
                            <td>{$row['HoTen']}</td>
                            <td>{$row['GioiTinh']}</td>
                            <td>{$row['SoDienThoai']}</td>
                            <td>
                                <a href=\"/#\" class=\"btn btn-warning\"
                                data-id=\"{$row['MaSV']}\"
                                data-name=\"{$row['HoTen']}\"
                                data-sex=\"{$row['GioiTinh']}\"
                                data-phone=\"{$row['SoDienThoai']}\"
                                data-bs-toggle=modal
                                data-bs-target=#editModal
                                >
                                Sửa
                                </a>
                                <a href=\"/#\" class=\"btn btn-danger\"
                                data-id=\"{$row['MaSV']}\"
                                data-bs-toggle=modal
                                data-bs-target=#delModal
                                >
                                Xóa
                                </a>
                            </td>
                        </tr>
                        ";
                    }
                }
            ?>
        </tbody>
    </table>
    <a href="#"
    class="btn btn-primary"
    data-bs-toggle=modal
    data-bs-target=#add
    >Thêm sinh viên</a>


    <!-- MODAL -->
     <div class="modal fade" id="add" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <form method="POST" action="/student_manage/add">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Thêm sinh viên</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="add-id" class="form-label">Mã sinh viên</label>
                                <input type="text" name="MaSV" id="add-id" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="add-ten" class="form-label">Họ Tên</label>
                                <input type="text" name="HoTen" id="add-ten" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="add-sdt" class="form-label">Số điện thoại</label>
                                <input type="text" max="10" name="SDT" id="add-sdt" class="form-control" required>
                            </div>
                            <div class="mb-3 g-2">
                                <label for="male" class="mx-2">Nam</label><input type="radio" name="sex" id="male" value="Nam">
                                <label for="female" class="mx-2">Nữ</label><input type="radio" name="sex" id="female" value="Nữ">
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
        <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <form method="POST" action="/student_manage/edit">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Sửa thông tin sinh viên</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            <input type="hidden" name="Old-MaSV" id="edit" class="form-control" required>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="add-id" class="form-label">Mã sinh viên</label>
                                <input type="text" name="MaSV" id="edit-id" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="add-ten" class="form-label">Họ Tên</label>
                                <input type="text" name="HoTen" id="edit-ten" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="add-sdt" class="form-label">Số điện thoại</label>
                                <input type="text" max="10" name="SoDienThoai" id="edit-sdt" class="form-control" required>
                            </div>
                            <div class="mb-3 g-2">
                                <label for="male" class="mx-2">Nam</label><input type="radio" name="sex" id="male" value="Nam">
                                <label for="female" class="mx-2">Nữ</label><input type="radio" name="sex" id="female" value="Nữ">
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
        <div class="modal fade" id="delModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <form method="POST" action="/student_manage/delete">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Thông báo</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label id="del-label" class="form-label"></label>
                                <input type="hidden" name="MaSV" id="del-id">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                            <button type="submit" class="btn btn-primary">Xác nhận</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>  
</div>
<script src="/js/students.js"></script>
<script src="/js/printf.js"></script>
<?php $this->stop(); ?>
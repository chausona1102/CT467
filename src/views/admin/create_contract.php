<?php $this->layout('layout-admin'); ?>
<?php $this->start('page-css'); ?>
<link rel="stylesheet" href="/css/admin.css">
<?php $this->stop(); ?>
<?php $this->start("page-content"); ?>
<div class="container-fluid py-5">
    <div class="card card-custom">
        <div class="card-header bg-white border-0 py-4">
            <h2 class="card-title text-center mb-0 text-danger">
                <i class="bi bi-phone me-2"></i>Thêm Hợp Đồng Mới
            </h2>
        </div>
        <div class="container my-4">
            <form>
                <div class="mb-3">
                    <label class="form-label">Mã hợp đồng</label>
                    <input type="text" class="form-control" name="ma_hd" placeholder="HD001">
                </div>
                <div class="mb-3">
                    <label class="form-label">Mã sinh viên</label>
                    <select class="form-select" name="ma_sv">
                        <option value="">-- Chọn sinh viên --</option>
                        <option value="SV001">SV001 - Nguyễn Văn A</option>
                        <option value="SV002">SV002 - Trần Thị B</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Mã phòng</label>
                    <select class="form-select" name="ma_phong">
                        <option value="">-- Chọn phòng --</option>
                        <option value="P101">P101</option>
                        <option value="P102">P102</option>
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Ngày bắt đầu</label>
                        <input type="date" class="form-control" name="ngay_bat_dau">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Ngày kết thúc</label>
                        <input type="date" class="form-control" name="ngay_ket_thuc">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Lưu</button>
                <button type="reset" class="btn btn-secondary">Hủy</button>
            </form>
        </div>
    </div>
</div>
<?php $this->stop(); ?>
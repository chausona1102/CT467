<?php $this->layout('layout-admin'); ?>
<?php $this->start('page-css'); ?>
<link rel="stylesheet" href="/css/admin.css">
<?php $this->stop(); ?>
<?php $this->start("page-content"); ?>
<div class="container-fluid py-5">
    <div class="card card-custom">
        <div class="card-header bg-white border-0 py-4">
            <h2 class="card-title text-center mb-0 text-danger">
                <i class="bi bi-phone me-2"></i>Sửa Sử Dụng Dịch Vụ
            </h2>
        </div>
        <div class="container my-4">
            <form>
                <div class="mb-3">
                    <label class="form-label">Mã SDDV</label>
                    <input type="text" class="form-control" name="ma_sddv" placeholder="SDDV001">
                </div>
                <div class="mb-3">
                    <label class="form-label">Mã hợp đồng</label>
                    <select class="form-select" name="ma_hd">
                        <option value="">-- Chọn hợp đồng --</option>
                        <option value="HD001">HD001</option>
                        <option value="HD002">HD002</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Mã dịch vụ</label>
                    <select class="form-select" name="ma_dv">
                        <option value="">-- Chọn dịch vụ --</option>
                        <option value="DV001">Internet</option>
                        <option value="DV002">Điện</option>
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Số lượng sử dụng</label>
                        <input type="number" class="form-control" name="so_luong" placeholder="1">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Tháng</label>
                        <input type="number" class="form-control" name="thang" placeholder="7">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Năm</label>
                        <input type="number" class="form-control" name="nam" placeholder="2025">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Lưu</button>
                <button type="reset" class="btn btn-secondary">Hủy</button>
            </form>
        </div>
    </div>
</div>
<?php $this->stop(); ?>
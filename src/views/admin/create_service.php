<?php $this->layout('layout-admin'); ?>
<?php $this->start('page-css'); ?>
<link rel="stylesheet" href="/css/admin.css">
<?php $this->stop(); ?>
<?php $this->start("page-content"); ?>
<div class="container-fluid py-5">
    <div class="card card-custom">
        <div class="card-header bg-white border-0 py-4">
            <h2 class="card-title text-center mb-0 text-danger">
                <i class="bi bi-phone me-2"></i>Thêm Dịch Vụ Mới
            </h2>
        </div>
        <div class="container my-4">
            <form>
                <div class="mb-3">
                    <label class="form-label">Mã dịch vụ</label>
                    <input type="text" class="form-control" name="ma_dv" placeholder="DV001">
                </div>
                <div class="mb-3">
                    <label class="form-label">Tên dịch vụ</label>
                    <input type="text" class="form-control" name="ten_dv" placeholder="Internet, Điện, Nước...">
                </div>
                <div class="mb-3">
                    <label class="form-label">Đơn giá</label>
                    <input type="number" class="form-control" name="don_gia" placeholder="100000">
                </div>
                <button type="submit" class="btn btn-primary">Lưu</button>
                <button type="reset" class="btn btn-secondary">Hủy</button>
            </form>
        </div>
    </div>
</div>
<?php $this->stop(); ?>
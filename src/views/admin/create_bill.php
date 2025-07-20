<?php $this->layout('layout-admin'); ?>
<?php $this->start('page-css'); ?>
<link rel="stylesheet" href="/css/admin.css">
<?php $this->stop(); ?>
<?php $this->start("page-content"); ?>
<div class="container-fluid py-5">
    <div class="card card-custom">
        <div class="card-header bg-white border-0 py-4">
            <h2 class="card-title text-center mb-0 text-danger">
                <i class="bi bi-phone me-2"></i>Thêm Hóa Đơn Mới
            </h2>
        </div>
        <div class="container my-4">
            <form>
                <div class="mb-3">
                    <label class="form-label">Mã hóa đơn</label>
                    <input type="text" class="form-control" name="ma_hoa_don" placeholder="HDN001">
                </div>
                <div class="mb-3">
                    <label class="form-label">Mã SDDV</label>
                    <select class="form-select" name="ma_sddv">
                        <option value="">-- Chọn mã SDDV --</option>
                        <option value="SDDV001">SDDV001</option>
                        <option value="SDDV002">SDDV002</option>
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Ngày lập hóa đơn</label>
                        <input type="date" class="form-control" name="ngay_lap">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Ngày hết hạn</label>
                        <input type="date" class="form-control" name="ngay_het_han">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tổng tiền thanh toán</label>
                    <input type="number" class="form-control" name="tong_tien" placeholder="500000">
                </div>
                <button type="submit" class="btn btn-primary">Lưu</button>
                <button type="reset" class="btn btn-secondary">Hủy</button>
            </form>
        </div>

    </div>
</div>
<?php $this->stop(); ?>
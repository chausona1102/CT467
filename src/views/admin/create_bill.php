<?php

use App\models\BillModel;

 $this->layout('layout-admin'); ?>
<?php $this->start('page-css'); ?>
<link rel="stylesheet" href="/css/admin.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-container--default .select2-selection--single {
        height: calc(2.5rem + 2px);
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        border: 1px solid #ced4da;
        border-radius: 0.375rem;
    }

    .select2-container .select2-selection--single .select2-selection__rendered {
        padding-left: 0;
    }

    .select2-container--default .select2-selection--single .select2-selection__clear {
        display: none !important;
    }
</style>
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
            <?php if (!empty($errors)) : ?>
                <div class="alert alert-danger">
                    <?= is_array($errors) ? implode('<br>', $errors) : $errors ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($_SESSION['error'])) : ?>
                <div class="alert alert-danger">
                    <?= $_SESSION['error'] ?>
                    <?php unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>
            <form action="/admin/bill/store" method="post">
                <div class="mb-3">
                    <label class="form-label">Mã hóa đơn</label>
                    <input type="text" class="form-control" name="ma_hoa_don">
                </div>
                <div class="mb-3">
                    <label class="form-label">Mã SDDV</label>
                    <select class="form-select js-select2" name="ma_sddv">
                        <option value="">-- Chọn mã SDDV --</option>
                        <?php foreach ($maSDDVList as $maSDDV): ?>
                            <option value="<?= $maSDDV['MaSDDV'] ?>">
                                <?= $maSDDV['MaSDDV']?>
                            </option>
                        <?php endforeach; ?>
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
                <!-- <div class="mb-3">
                    <label class="form-label">Tổng tiền thanh toán</label>
                    <input type="number" class="form-control" name="tong_tien">
                </div> -->
                <button type="submit" class="btn btn-primary">Lưu</button>
                <a href="/bill_manage" class="btn btn-secondary">Hủy</a>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.js-select2').select2({
            tags: true,
            allowClear: true,
        });
    });
</script>
<?php $this->stop(); ?>
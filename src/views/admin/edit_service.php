<?php $this->layout('layout-admin'); ?>
<?php $this->start('page-css'); ?>
<link rel="stylesheet" href="/css/admin.css">
<?php $this->stop(); ?>
<?php $this->start("page-content"); ?>
<div class="container-fluid py-5">
    <div class="card card-custom">
        <div class="card-header bg-white border-0 py-4">
            <h2 class="card-title text-center mb-0 text-danger">
                <i class="bi bi-phone me-2"></i>Sửa Dịch Vụ
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

            <form action="/admin/service/update/<?php echo htmlspecialchars($service['MaDV'] ?? ''); ?>" method="POST">
                <input type="hidden" name="old_id" value="<?php echo htmlspecialchars($service['MaDV'] ?? ''); ?>">
                <div class="mb-3">
                    <label class="form-label">Mã dịch vụ</label>
                    <input type="text" class="form-control" name="ma_dv" value="<?php echo htmlspecialchars($service['MaDV'] ?? ''); ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Tên dịch vụ</label>
                    <input type="text" class="form-control" name="ten_dv" value="<?php echo htmlspecialchars($service['TenDV'] ?? ''); ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Đơn giá</label>
                    <input type="number" class="form-control" name="don_gia" value="<?php echo htmlspecialchars($service['DonGia'] ?? ''); ?>">
                </div>
                <button type="submit" class="btn btn-primary">Lưu</button>
                <a href="/service_manage" class="btn btn-secondary">Hủy</a>
            </form>
        </div>
    </div>
</div>
<?php $this->stop(); ?>
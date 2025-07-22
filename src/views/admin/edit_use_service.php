<?php $this->layout('layout-admin'); ?>
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
                <i class="bi bi-phone me-2"></i>Sửa Sử Dụng Dịch Vụ
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

            <form action="/admin/use-service/update/<?php echo htmlspecialchars($useService['MaSDDV'] ?? ''); ?>" method="POST">
                <input type="hidden" name="old_id" value="<?php echo htmlspecialchars($useService['MaSDDV'] ?? ''); ?>">
                <div class="mb-3">
                    <label class="form-label">Mã SDDV</label>
                    <input type="text" class="form-control" name="MaSDDV" value="<?php echo htmlspecialchars($useService['MaSDDV'] ?? ''); ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Mã hợp đồng</label>
                    <select class="form-select js-select2" name="MaHD">
                        <?php foreach ($maHDList as $maHD): ?>
                            <option value="<?= $maHD['MaHD'] ?>"
                                <?= ($useService['MaHD'] ?? '') === $maHD['MaHD'] ? 'selected' : '' ?>>
                                <?= $maHD['MaHD'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Mã dịch vụ</label>
                    <select class="form-select js-select2" name="MaDV">
                        <?php foreach ($maDVList as $maDV): ?>
                            <option value="<?= $maDV['MaDV'] ?>"
                                <?= ($useService['MaDV'] ?? '') === $maDV['MaDV'] ? 'selected' : '' ?>>
                                <?= $maDV['MaDV'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Số lượng sử dụng</label>
                        <input type="number" class="form-control" name="SoLuongSuDung" value="<?php echo htmlspecialchars($useService['SoLuongSuDung'] ?? ''); ?>">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Tháng</label>
                        <input type="number" class="form-control" name="Thang" value="<?php echo htmlspecialchars($useService['Thang'] ?? ''); ?>">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Năm</label>
                        <input type="number" class="form-control" name="Nam" value="<?php echo htmlspecialchars($useService['Nam'] ?? ''); ?>">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Lưu</button>
                <a href="/use_service" class="btn btn-secondary">Hủy</a>
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
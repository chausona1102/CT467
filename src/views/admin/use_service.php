<?php $this->layout('layout-admin'); ?>
<?php $this->start('page-css'); ?>
<link rel="stylesheet" href="/css/admin.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<?php $this->stop(); ?>
<?php $this->start("page-content"); ?>
<div class="container">
    <h2 class="text-center animate__animated animate__bounce">Sử Dụng Dịch Vụ</h2>
    <div class="row">
        <div class="col-12">
            <?php if (isset($_SESSION['success_Mess'])): ?>
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <?php echo $_SESSION['success_Mess']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php unset($_SESSION['success_Mess']); ?>
            <?php endif; ?>

            <a href="/admin/use-service/create" class="btn btn-success mb-3">
                <i class="fas fa-plus-circle"></i> Tạo mới
            </a>
            <a href="/use_service?export=excel" class="btn btn-success mb-3">
                <i class="fas fa-plus-circle"></i> Print Excel
            </a>

            <div class="d-flex justify-content-between mb-3">
                <div>
                    <label class="me-2">Show</label>
                    <select id="entries-per-page" class="">
                        <option value="5">5</option>
                        <option value="10" selected>10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <label class="ms-2">entries</label>
                </div>
                <div>
                    <input type="text" id="custom-search" class="form-control form-control-sm" placeholder="Search...">
                </div>
            </div>
            <!-- Table Starts Here -->
            <table id="use-services" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Mã SDDV</th>
                        <th scope="col">Mã hợp đồng</th>
                        <th scope="col">Mã dịch vụ</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Tháng</th>
                        <th scope="col">Năm</th>
                        <th scope="col">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($useservice as $useService): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($useService['MaSDDV']); ?></td>
                            <td><?php echo htmlspecialchars($useService['MaHD']); ?></td>
                            <td><?php echo htmlspecialchars($useService['MaDV']); ?></td>
                            <td><?php echo htmlspecialchars($useService['SoLuongSuDung']); ?></td>
                            <td><?php echo htmlspecialchars($useService['Thang']); ?></td>
                            <td><?php echo htmlspecialchars($useService['Nam']); ?></td>
                            <td class="text-center align-middle">
                                <div class="d-flex justify-content-center align-items-center">
                                    <a href="/admin/use-service/edit/<?php echo htmlspecialchars($useService['MaSDDV']); ?>" class="btn btn-xs btn-warning">
                                        <i alt="Edit" class="fa fa-pencil"></i> Sửa
                                    </a>
                                    <form class="ms-2" action="/admin/use-service/delete/<?php echo htmlspecialchars($useService['MaSDDV']); ?>" method="POST">
                                        <button type="submit" class="btn btn-xs btn-danger" name="delete-use-service">
                                            <i alt="Delete" class="fa fa-trash"></i> Xóa
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div id="delete-confirm" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title"><i class="fas fa-exclamation-triangle"></i> Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                    <p class="lead"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" data-bs-dismiss="modal" class="btn btn-secondary">Cancel</button>
                    <button type="button" class="btn btn-danger" id="delete">Delete</button>
                </div>
            </div>
        </div>
    </div>

</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let table = new DataTable("#use-services", {
            responsive: true,
            pagingType: "simple_numbers",
            lengthChange: false,
            searching: true,
            dom: 'lrtip'
        });

        document.getElementById("entries-per-page").addEventListener("change", function() {
            table.page.len(this.value).draw();
        });

        document.getElementById("custom-search").addEventListener("keyup", function() {
            table.search(this.value).draw();
        });

        const modalEl = document.getElementById('delete-confirm');
        const confirmModal = new bootstrap.Modal(modalEl, {
            backdrop: 'static',
            keyboard: false
        });
        let currentForm = null;

        const deleteButtons = document.querySelectorAll('button[name="delete-use-service"]');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();

                currentForm = button.closest('form');
                const nameTd = button.closest('tr').querySelector('td:first-child');
                const MaSDDV = nameTd ? nameTd.textContent.trim() : "này";
                document.querySelector('.modal-body p').textContent = `Bạn có chắc muốn xóa "${MaSDDV}"?`;

                confirmModal.show();
            });
        });

        document.getElementById('delete').addEventListener('click', function() {
            if (currentForm) currentForm.submit();
        });
    });
</script>
<?php $this->stop(); ?>
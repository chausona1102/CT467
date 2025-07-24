<?php $this->layout('layout-admin'); ?>
<?php $this->start('page-css'); ?>
<link rel="stylesheet" href="/css/admin.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<?php $this->stop(); ?>
<?php $this->start("page-content"); ?>
<div class="container">
    <h2 class="text-center animate__animated animate__bounce">Hợp Đồng</h2>
    <div class="row">
        <div class="col-12">
            <?php if (isset($_SESSION['success_Mess'])): ?>
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <?php echo $_SESSION['success_Mess']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php unset($_SESSION['success_Mess']); ?>
            <?php endif; ?>

            <a href="/admin/contract/create" class="btn btn-success mb-3">
                <i class="fas fa-plus-circle"></i> Tạo thêm
            </a>

            <a href="/contract_manage?export=excel" class="btn btn-success mb-3">
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
            <table id="contract" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Mã hợp đồng</th>
                        <th scope="col">Mã SV</th>
                        <th scope="col">Mã phòng</th>
                        <th scope="col">Ngày bắt đầu</th>
                        <th scope="col">Ngày kết thúc</th>
                        <th scope="col">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($contract as $contract): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($contract['MaHD']); ?></td>
                            <td><?php echo htmlspecialchars($contract['MaSV']); ?></td>
                            <td><?php echo htmlspecialchars($contract['MaPhong']); ?></td>
                            <td><?php echo htmlspecialchars($contract['NgayBatDau']); ?></td>
                            <td><?php echo htmlspecialchars($contract['NgayKetThuc']); ?></td>
                            <td class="text-center align-middle">
                                <div class="d-flex justify-content-center align-items-center gap-2">
                                    <a href="/admin/contract/edit/<?php echo htmlspecialchars($contract['MaHD']); ?>" class="btn btn-xs btn-warning">
                                        Sửa
                                    </a>
                                    <form action="/admin/contract/delete/<?php echo htmlspecialchars($contract['MaHD']); ?>" method="POST" style="display:inline;">
                                        <button type="submit" class="btn btn-xs btn-danger" name="delete-contract">
                                            Xóa
                                        </button>
                                    </form>
                                    <form action="/admin/contract/check/<?php echo htmlspecialchars($contract['MaSV']); ?>" method="POST" style="display:inline;">
                                        <button type="submit" class="btn btn-primary">
                                            Kiểm Tra
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

    <!-- Modal Kiểm Tra -->
    <div class="modal fade" id="check-modal" tabindex="-1" aria-labelledby="checkModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="checkModalLabel"><i class="fas fa-info-circle"></i> Kết quả kiểm tra</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                </div>
                <div class="modal-body text-center">
                    <p class="lead">
                        <?php if (isset($_SESSION['info'])): ?>
                            <?= htmlspecialchars($_SESSION['info']); ?>
                            <?php unset($_SESSION['info']); ?>
                        <?php else: ?>
                            Không có thông tin kiểm tra.
                        <?php endif; ?>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Xóa -->
    <div id="delete-confirm" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title"><i class="fas fa-exclamation-triangle"></i> Xác nhận xóa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                    <p class="lead"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" data-bs-dismiss="modal" class="btn btn-secondary">Hủy</button>
                    <button type="button" class="btn btn-danger" id="delete">Xóa</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let table = new DataTable("#contract", {
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

        // Modal xác nhận xóa
        const modalEl = document.getElementById('delete-confirm');
        const confirmModal = new bootstrap.Modal(modalEl, { backdrop: 'static', keyboard: false });
        let currentForm = null;

        document.querySelectorAll('button[name="delete-contract"]').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                currentForm = button.closest('form');
                const MaHD = button.closest('tr').querySelector('td:first-child').textContent.trim();
                document.querySelector('#delete-confirm .modal-body p').textContent = `Bạn có chắc muốn xóa hợp đồng "${MaHD}"?`;
                confirmModal.show();
            });
        });

        document.getElementById('delete').addEventListener('click', function() {
            if (currentForm) currentForm.submit();
        });

        // Mở modal kiểm tra nếu có thông tin trong session
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('showCheckModal') === '1') {
            const checkModal = new bootstrap.Modal(document.getElementById('check-modal'));
            checkModal.show();
        }
    });
</script>
<?php $this->stop(); ?>

<?php $this->layout('layout-admin'); ?>
<?php $this->start('page-css'); ?>
<link rel="stylesheet" href="/css/admin.css">
<link rel="stylesheet" href="/css/room_manage.css">
<?php $this->stop(); ?>
<?php $this->start("page-content"); ?>
<div class="container">
    <h2 class="text-center animate__animated animate__bounce">Hóa Đơn</h2>
    <div class="row">
        <div class="col-12">
            <?php if (isset($_SESSION['success_Mess'])): ?>
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <?php echo $_SESSION['success_Mess']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php unset($_SESSION['success_Mess']); ?>
            <?php endif; ?>

            <a href="/admin/bill_manage/create" class="btn btn-success mb-3">
                <i class="fas fa-plus-circle"></i> Tạo thêm
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
            <table id="bill" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Mã hóa đơn</th>
                        <th scope="col">Mã SDDV</th>
                        <th scope="col">Ngày lập</th>
                        <th scope="col">Ngày hết hạn</th>
                        <th scope="col">Tổng tiền</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>HD001</td>
                        <td>SDDV01</td>
                        <td>2024-06-01</td>
                        <td>2024-06-30</td>
                        <td>1.500.000₫</td>
                        <td><span class="badge bg-danger">Chưa thanh toán</span></td>
                        <td class="text-center align-middle">
                            <div class="d-flex justify-content-center align-items-center">
                                <a href="/admin/bill_manage/edit/" class="btn btn-xs btn-warning">
                                    <i alt="Edit" class="fa fa-pencil"></i> Sửa
                                </a>
                                <form class="ms-2" action="/admin/bill_manage/delete/" method="POST">
                                    <button type="submit" class="btn btn-xs btn-danger" name="delete-service">
                                        <i alt="Delete" class="fa fa-trash"></i> Xóa
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <!-- Table Ends Here -->
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
                    <p class="lead">Are you sure you want to delete this service?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" data-bs-dismiss="modal" class="btn btn-secondary">Cancel</button>
                    <button type="button" class="btn btn-danger" id="delete">Delete</button>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let table = new DataTable("#bill", {
            responsive: true,
            pagingType: "simple_numbers",
            lengthChange: false,
            searching: true
        });

        document.getElementById("entries-per-page").addEventListener("change", function() {
            table.page.len(this.value).draw();
        });

        document.getElementById("custom-search").addEventListener("keyup", function() {
            table.search(this.value).draw();
        });

        const deleteButtons = document.querySelectorAll('button[name="delete-bill"]');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const form = button.closest('form');
                const nameTd = button.closest('tr').querySelector('td:nth-child(3)');
                if (nameTd) {
                    document.querySelector('.modal-body p').textContent =
                        `Do you want to delete "${nameTd.textContent}"?`;
                }
                const submitForm = function() {
                    form.submit();
                };
                document.getElementById('delete').addEventListener('click', submitForm, {
                    once: true
                });

                const modalEl = document.getElementById('delete-confirm');
                modalEl.addEventListener('hidden.bs.modal', function() {
                    document.getElementById('delete').removeEventListener('click', submitForm);
                });

                const confirmModal = new bootstrap.Modal(modalEl, {
                    backdrop: 'static',
                    keyboard: false
                });
                confirmModal.show();
            });
        });
    });
</script>
<?php $this->stop(); ?>
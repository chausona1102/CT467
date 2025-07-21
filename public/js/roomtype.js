document.addEventListener('DOMContentLoaded', () => {
  const editButtons = document.querySelectorAll('.btn-edit');
  editButtons.forEach(btn => {
    btn.addEventListener('click', () => {
      document.getElementById('edit-id').value = btn.dataset.id;
      document.getElementById('edit-ma').value = btn.dataset.id;
      document.getElementById('edit-ten').value = btn.dataset.ten;
      document.getElementById('edit-gia').value = btn.dataset.gia;
    });
  });
});

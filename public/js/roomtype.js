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

const delLable = document.getElementById('del-label')
const delModal = document.getElementById('delRoomTypeModal');
delModal.addEventListener('show.bs.modal', event => {
    const button = event.relatedTarget;
    const id = button.getAttribute('data-id');
    const input = delModal.querySelector('#del-id');
    input.value = id;

    // delModal.querySelector('#del-id').value = id;
    delLable.innerHTML = `<label>Chắc chắn xóa <span style="color: red;">${id}</span></label>`;
});


// ?ADD?
// DEL
const delLable = document.getElementById('del-label');
const delModal = document.getElementById('delModal');
delModal.addEventListener('show.bs.modal', event => {
    const btn = event.relatedTarget;
    const id = btn.getAttribute('data-id');
    const input = delModal.querySelector("#del-id");
    input.value = id;
    delModal.querySelector('#del-id').value = id;
    delLable.innerHTML = `<label>Chắc chắn xóa <span style="color: red;">${id}</span></label>`;
})
// EDIT 

const editModal = document.getElementById('editModal');

editModal.addEventListener('show.bs.modal', event => {
    const btn = event.relatedTarget;
    const masv = btn.getAttribute('data-id');
    const hoten = btn.getAttribute('data-name');
    const gioitinh = btn.getAttribute('data-sex');
    const sdt = btn.getAttribute('data-phone');
    editModal.querySelector('input[name="Old-MaSV"]').value = masv;
    editModal.querySelector('input[name="MaSV"]').value = masv;
    editModal.querySelector('input[name="HoTen"]').value = hoten;
    if(gioitinh == "Nam") {
        editModal.querySelector('input[name="sex"][id="male"]').checked = true;
    }else if(gioitinh == "Nữ"){
        editModal.querySelector('input[name="sex"][id="female"]').checked = true;
    }else {
        editModal.querySelector('input[name="sex"][id="male"]').checked = false;
        editModal.querySelector('input[name="sex"][id="female"]').checked = false;
    }
    editModal.querySelector('input[name="SoDienThoai"]').value = sdt;
})



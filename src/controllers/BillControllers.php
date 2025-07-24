<?php

namespace App\controllers;

use App\models\BillModel;

class BillControllers extends Controller
{
    protected $billModel;

    public function __construct()
    {
        parent::__construct();
        $this->billModel = new BillModel();
    }
    public function index()
    {
        if (isset($_GET['export']) && $_GET['export'] === 'excel') {
            $this->billModel->exportToExcel();
            return;
        }

        $bill = $this->billModel->all();

        if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] === true) {
            $data = [
                'bill' => $bill,
                'successMessage' => $_SESSION['success_Mess'] ?? null
            ];
            $this->render('admin/bill_manage', $data);
        } else {
            header('Location: /login');
            exit();
        }
    }

    public function create()
    {
        $errors = $_SESSION['errors'] ?? null;
        $formData = $_SESSION['form'] ?? null;
        unset($_SESSION['errors'], $_SESSION['form']);

        $maSDDVList = $this->billModel->getAllMaSDDV();

        echo $this->render('admin/create_bill', [
            'errors' => $errors,
            'formData' => $formData,
            'maSDDVList' => $maSDDVList
        ]);
    }

    public function store()
    {
        $data = [
            'MaHoaDon' => $_POST['ma_hoa_don'] ?? '',
            'MaSDDV' => $_POST['ma_sddv'] ?? '',
            'NgayLap' => $_POST['ngay_lap'] ?? '',
            'NgayHetHan' => $_POST['ngay_het_han'] ?? ''
        ];

        if (empty($data['MaHoaDon']) || empty($data['MaSDDV']) || empty($data['NgayLap']) || empty($data['NgayHetHan'])) {
            $_SESSION['error'] = 'Vui lòng nhập đầy đủ thông tin';
            $_SESSION['form'] = $data;
            header('Location: /admin/bill/create');
            exit;
        }

        if ($this->billModel->getBillById($data['MaHoaDon'])) {
            $_SESSION['error'] = 'Mã hóa đơn đã tồn tại. Vui lòng chọn mã khác.';
            $_SESSION['form'] = $data;
            header('Location: /admin/bill/create');
            exit;
        }

        if ($this->billModel->isMaSDDVUsed($data['MaSDDV'])) {
            $_SESSION['error'] = 'Hóa đơn đã được tạo từ trước.';
            $_SESSION['form'] = $data;
            header('Location: /admin/bill/create');
            exit;
        }

        $success = $this->billModel->add($data);

        if ($success) {
            $_SESSION['success'] = 'Thêm hóa đơn thanh công!';
            header('Location: /bill_manage');
        } else {
            $_SESSION['error'] = 'Đã xảy ra lỗi khi thêm. vui lòng thử lại.';
            $_SESSION['form'] = $data;
            header('Location: /admin/bill/create');
        }
    }

    public function edit($id)
    {
        $maSDDVList = $this->billModel->getAllMaSDDV();
        $data = [
            'bill' => $this->billModel->getBillById($id),
            'maSDDVList' => $maSDDVList
        ];
        $this->render('admin/edit_bill', $data);
    }

    public function update()
    {
        $data = [
            'old_id' => $_POST['old_id'] ?? '',
            'MaHoaDon' => $_POST['ma_hoa_don'] ?? '',
            'MaSDDV' => $_POST['ma_sddv'] ?? '',
            'NgayLap' => $_POST['ngay_lap'] ?? '',
            'NgayHetHan' => $_POST['ngay_het_han'] ?? '',
            'TongTien' => $_POST['tong_tien'] ?? '',
            'TrangThai' => $_POST['trang_thai'] ?? ''
        ];

        if (empty($data['MaHoaDon']) || empty($data['MaSDDV']) || empty($data['NgayLap']) || empty($data['NgayHetHan']) || empty($data['TongTien'])) {
            $_SESSION['error'] = 'Vui lòng nhập đầy đủ thông tin.';
            $_SESSION['form'] = $data;
            header('Location: /admin/bill/edit/' . $data['old_id']);
            exit;
        }

        if ($data['MaHoaDon'] !== $data['old_id']) {
            if ($this->billModel->exists($data['MaHoaDon'])) {
                $_SESSION['error'] = 'Mã hóa đơn đã tồn tại.';
                $_SESSION['form'] = $data;
                header('Location: /admin/bill/edit/' . $data['old_id']);
                exit;
            }
        }

        if ($this->billModel->update($data)) {
            $_SESSION['success'] = 'Cập nhật thành công!';
        } else {
            $_SESSION['error'] = 'Đã xảy ra lỗi khi cập nhật.';
        }
        header('Location: /bill_manage');
        exit;
    }

    public function delete($id)
    {
        $this->billModel->delete($id);
        header('Location: /bill_manage');
        exit;
    }
}

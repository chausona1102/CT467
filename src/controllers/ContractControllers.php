<?php

namespace App\controllers;

use App\models\ConTractModel;


class ContractControllers extends Controller
{
    protected $contractModel;

    public function __construct()
    {
        parent::__construct();
        $this->contractModel = new ConTractModel();
    }
    public function index()
    {
        if (isset($_GET['export']) && $_GET['export'] === 'excel') {
            $this->contractModel->exportToExcel();
            return;
        }
        $contract = $this->contractModel->all();
        if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] === true) {
            $data = [
                'contract' => $contract,
                'successMessage' => $_SESSION['success_Mess'] ?? null
            ];
            $this->render('admin/contract_manage', $data);
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

        $maSVList = $this->contractModel->getAllMaSV();
        $maPhongList = $this->contractModel->getAllMaPhong();
        $data = [
            'maSVList' => $maSVList,
            'maPhongList' => $maPhongList,
            'errors' => $errors,
            'formData' => $formData
        ];
        $this->render('admin/create_contract', $data);
    }

    public function store()
    {
        $data = [
            'MaHD' => $_POST['ma_hd'] ?? '',
            'MaSV' => $_POST['ma_sv'] ?? '',
            'MaPhong' => $_POST['ma_phong'] ?? '',
            'NgayBatDau' => $_POST['ngay_bat_dau'] ?? '',
            'NgayKetThuc' => $_POST['ngay_ket_thuc'] ?? ''
        ];

        if (empty($data['MaHD']) || empty($data['MaSV']) || empty($data['MaPhong']) || empty($data['NgayBatDau']) || empty($data['NgayKetThuc'])) {
            $_SESSION['error'] = 'Vui lòng nhập đầy đủ thông tin';
            $_SESSION['form'] = $data;
            header('Location: /admin/contract/create');
            exit;
        }

        if ($this->contractModel->getContractById($data['MaHD'])) {
            $_SESSION['error'] = 'Mã hợp đồng đã tồn tại. Vui lòng chọn mã khác.';
            $_SESSION['form'] = $data;
            header('Location: /admin/contract/create');
            exit;
        }

        try {
            $success = $this->contractModel->add($data);

            if ($success) {
                $_SESSION['success'] = 'Thêm hợp đồng thành công!';
                header('Location: /contract_manage');
                exit;
            } else {
                $_SESSION['error'] = 'Đã xảy ra lỗi khi thêm. Vui lòng thử lại.';
                $_SESSION['form'] = $data;
                header('Location: /admin/contract/create');
                exit;
            }
        } catch (\PDOException $e) {
            $fullMessage = $e->getMessage();

            if (preg_match('/1644 (.+)$/', $fullMessage, $matches)) {
                $errorMessage = $matches[1];
            } else {
                $errorMessage = $fullMessage;
            }

            $_SESSION['error'] = $errorMessage;
            $_SESSION['form'] = $data;
            header('Location: /admin/contract/create');
            exit;
        }
    }

    public function edit($id)
    {
        $maSVList = $this->contractModel->getAllMaSV();
        $maPhongList = $this->contractModel->getAllMaPhong();
        $contract = $this->contractModel->getContractById($id);
        $data = [
            'contract' => $contract,
            'maSVList' => $maSVList,
            'maPhongList' => $maPhongList
        ];
        $this->render('admin/edit_contract', $data);
    }

    public function update()
    {
        $data = [
            'old_id' => $_POST['old_id'] ?? '',
            'MaHD' => $_POST['ma_hd'] ?? '',
            'MaSV' => $_POST['ma_sv'] ?? '',
            'MaPhong' => $_POST['ma_phong'] ?? '',
            'NgayBatDau' => $_POST['ngay_bat_dau'] ?? '',
            'NgayKetThuc' => $_POST['ngay_ket_thuc'] ?? ''
        ];

        if (empty($data['MaHD']) || empty($data['MaSV']) || empty($data['MaPhong']) || empty($data['NgayBatDau']) || empty($data['NgayKetThuc'])) {
            $_SESSION['error'] = 'Vui lòng nhập đầy đủ thông tin';
            $_SESSION['form'] = $data;
            header('Location: /admin/contract/edit');
            exit;
        }

        if ($data['MaHD'] !== $data['old_id']) {
            if ($this->contractModel->exists($data['MaHD'])) {
                $_SESSION['error'] = 'Mã hợp đồng đã tồn tại.';
                $_SESSION['form'] = $data;
                header('Location: /admin/contract/edit/' . $data['old_id']);
                exit;
            }
        }

        try {
            $success = $this->contractModel->update($data);

            if ($success) {
                $_SESSION['success'] = 'Thêm hợp đồng thành công!';
                header('Location: /contract_manage');
                exit;
            } else {
                $_SESSION['error'] = 'Đã xảy ra lỗi khi thêm. Vui lòng thử lại.';
                $_SESSION['form'] = $data;
                header('Location: /admin/contract/edit/' . $data['old_id']);
                exit;
            }
        } catch (\PDOException $e) {
            $fullMessage = $e->getMessage();

            if (preg_match('/1644 (.+)$/', $fullMessage, $matches)) {
                $errorMessage = $matches[1];
            } else {
                $errorMessage = $fullMessage;
            }

            $_SESSION['error'] = $errorMessage;
            $_SESSION['form'] = $data;
            header('Location: /admin/contract/edit/' . $data['old_id']);
            exit;
        }
    }

    public function delete($id)
    {
        $this->contractModel->delete($id);
        header('Location: /contract_manage');
        exit;
    }

    public function check($id)
    {
        $result = $this->contractModel->check($id);

        if ($result && isset($result['KetQua'])) {
            $_SESSION['info'] = ($result['KetQua'] == 1) ? 'Hợp đồng đã hết hạn!' : 'Hợp đồng còn hạn.';
        } else {
            $_SESSION['info'] = 'Không tìm thấy hợp đồng.';
        }

        header('Location: /contract_manage?showCheckModal=1');
        exit;
    }
}

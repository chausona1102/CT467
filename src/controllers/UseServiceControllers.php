<?php

namespace App\controllers;

use App\models\UseServiceModel;

class UseServiceControllers extends Controller
{
    protected $UseServiceModel;

    public function __construct()
    {
        parent::__construct();
        $this->UseServiceModel = new UseServiceModel();
    }
    public function index()
    {
        if (isset($_GET['export']) && $_GET['export'] === 'excel') {
            $this->UseServiceModel->exportToExcel();
            return;
        }

        $useservices = $this->UseServiceModel->all();


        if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] === true) {
            $data = [
                'useservice' => $useservices,
                'successMessage' => $_SESSION['success_Mess'] ?? null
            ];
            $this->render('admin/use_service', $data);
        } else {
            header('Location: /login');
            exit();
        }
    }

    public function create()
    {
        $errors = $_SESSION['errors'] ?? null;
        $formData = $_SESSION['form'] ?? null;

        $maDVList = $this->UseServiceModel->getAllMaDV();
        $maHDList = $this->UseServiceModel->getAllMaHD();

        unset($_SESSION['errors'], $_SESSION['form']);

        $this->render('admin/create_use_service', [
            'errors' => $errors,
            'formData' => $formData,
            'maDVList' => $maDVList,
            'maHDList' => $maHDList
        ]);
    }

    public function store()
    {
        $data = [
            'MaSDDV' => $_POST['MaSDDV'] ?? '',
            'MaHD' => $_POST['MaHD'] ?? '',
            'MaDV' => $_POST['MaDV'] ?? '',
            'SoLuongSuDung' => $_POST['SoLuongSuDung'] ?? '',
            'Thang' => $_POST['Thang'] ?? '',
            'Nam' => $_POST['Nam'] ?? ''
        ];

        // Kiểm tra dữ liệu đầu vào
        if (
            empty($data['MaSDDV']) || empty($data['MaHD']) || empty($data['MaDV']) ||
            empty($data['SoLuongSuDung']) || empty($data['Thang']) || empty($data['Nam'])
        ) {
            $_SESSION['error'] = 'Vui lòng nhập đầy đủ thông tin.';
            $_SESSION['form'] = $data;
            header('Location: /admin/use-service/create');
            exit;
        }

        // Kiểm tra mã SDDV đã tồn tại chưa
        if ($this->UseServiceModel->getUseServiceById($data['MaSDDV'])) {
            $_SESSION['error'] = 'Mã SDDV đã tồn tại. Vui lòng chọn mã khác.';
            $_SESSION['form'] = $data;
            header('Location: /admin/use-service/create');
            exit;
        }

        // Gọi hàm thêm mới
        $success = $this->UseServiceModel->add($data);

        if ($success) {
            $_SESSION['success_Mess'] = 'Thêm thành công!';
            header('Location: /use_service');
        } else {
            $_SESSION['error'] = 'Đã xảy ra lỗi khi thêm.';
            $_SESSION['form'] = $data;
            header('Location: /admin/use-service/create');
        }

        exit;
    }


    public function edit($id)
    {
        $maDVList = $this->UseServiceModel->getAllMaDV();
        $maHDList = $this->UseServiceModel->getAllMaHD();
        $data = [
            'useService' => $this->UseServiceModel->getUseServiceById($id),
            'maDVList' => $maDVList,
            'maHDList' => $maHDList
        ];
        $this->render('admin/edit_use_service', $data);
    }

    public function update()
    {
        $data = [
            'old_id' => $_POST['old_id'] ?? '',
            'MaSDDV' => $_POST['MaSDDV'] ?? '',
            'MaHD' => $_POST['MaHD'] ?? '',
            'MaDV' => $_POST['MaDV'] ?? '',
            'SoLuongSuDung' => $_POST['SoLuongSuDung'] ?? '',
            'Thang' => $_POST['Thang'] ?? '',
            'Nam' => $_POST['Nam'] ?? ''
        ];

        if (empty($data['MaSDDV']) || empty($data['MaHD']) || empty($data['MaDV']) || empty($data['SoLuongSuDung']) || empty($data['Thang']) || empty($data['Nam'])) {
            $_SESSION['error'] = 'Vui lòng nhập đầy đủ thông tin.';
            $_SESSION['form'] = $data;
            header('Location: /admin/use-service/edit/' . $data['old_id']);
            exit;
        }

        if ($data['MaSDDV'] !== $data['old_id']) {
            if ($this->UseServiceModel->exists($data['MaSDDV'])) {
                $_SESSION['error'] = 'Mã SDDV đã tồn tại.';
                $_SESSION['form'] = $data;
                header('Location: /admin/use-service/edit/' . $data['old_id']);
                exit;
            }
        }

        if ($this->UseServiceModel->update($data)) {
            $_SESSION['success'] = 'Cập nhật thành công!';
        } else {
            $_SESSION['error'] = 'Đã xảy ra lỗi khi cập nhật.';
        }
        header('Location: /use_service');
        exit;
    }

    public function delete($id)
    {
        // Code to delete a service usage by ID
    }
}

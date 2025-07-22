<?php

namespace App\controllers;

use App\models\ServiceModel;

class ServiceControllers extends Controller
{
    protected $serviceModel;

    public function __construct()
    {
        parent::__construct();
        $this->serviceModel = new ServiceModel();
    }

    public function index()
    {
        if (isset($_GET['export']) && $_GET['export'] === 'excel') {
            $this->serviceModel->exportToExcel();
            return;
        }
      
        $services = $this->serviceModel->all();
       
        if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] === true) {
            $data = [
                'services' => $services,
                'successMessage' => $_SESSION['success_Mess'] ?? null,
            ];
            $this->render('admin/service_manage', $data);
        } else {
            header('Location: /login');
            exit();
        }
    }

    public function create()
    {
        $errors = $_SESSION['errors'] ?? null;
        $formData = $_SESSION['form'] ?? null;

        // Xoá session để tránh hiển thị lại sau reload
        unset($_SESSION['errors'], $_SESSION['form']);

        echo $this->render('admin/create_service', [
            'errors' => $errors,
            'formData' => $formData
        ]);
    }

    public function store()
    {
        $data = [
            'MaDV' => $_POST['ma_dv'] ?? '',
            'TenDV' => $_POST['ten_dv'] ?? '',
            'DonGia' => $_POST['don_gia'] ?? ''
        ];

        // Kiểm tra dữ liệu đầu vào
        if (empty($data['MaDV']) || empty($data['TenDV']) || empty($data['DonGia'])) {
            $_SESSION['error'] = 'Vui lòng nhập đầy đủ thông tin.';
            $_SESSION['form'] = $data;
            header('Location: /admin/service/create');
            exit;
        }

        // Kiểm tra MaDV đã tồn tại chưa
        if ($this->serviceModel->getServiceById($data['MaDV'])) {
            $_SESSION['error'] = 'Mã dịch vụ đã tồn tại. Vui lòng chọn mã khác.';
            $_SESSION['form'] = $data;
            header('Location: /admin/service/create');
            exit;
        }

        // Gọi hàm tạo mới
        $success = $this->serviceModel->add($data);

        if ($success) {
            $_SESSION['success'] = 'Thêm dịch vụ thành công!';
            header('Location: /service_manage');
        } else {
            $_SESSION['error'] = 'Đã xảy ra lỗi khi thêm dịch vụ.';
            $_SESSION['form'] = $data;
            header('Location: /admin/service/create');
        }
        exit;
    }

    public function edit($id)
    {
        $data = [
            'service' => $this->serviceModel->getServiceById($id),
            'errors' => $_SESSION['errors'] ?? null,
        ];
        $this->render('admin/edit_service', $data);
    }

    public function update($id)
    {
        $data = [
            'old_id' => $_POST['old_id'] ?? '',
            'MaDV' => $_POST['ma_dv'] ?? '',
            'TenDV' => $_POST['ten_dv'] ?? '',
            'DonGia' => $_POST['don_gia'] ?? ''
        ];

        // Kiểm tra dữ liệu đầu vào
        if (empty($data['MaDV']) || empty($data['TenDV']) || empty($data['DonGia'])) {
            $_SESSION['error'] = 'Vui lòng nhập đầy đủ thông tin.';
            $_SESSION['form'] = $data;
            header('Location: /admin/service/edit/' . $data['old_id']);
            exit;
        }

        // Kiểm tra đơn giá là số dương
        if (!is_numeric($data['DonGia']) || $data['DonGia'] <= 0) {
            $_SESSION['error'] = 'Đơn giá phải là số dương.';
            $_SESSION['form'] = $data;
            header('Location: /admin/service/edit/' . $data['old_id']);
            exit;
        }

        // Nếu mã DV bị thay đổi thì kiểm tra trùng mã
        if ($data['MaDV'] !== $data['old_id']) {
            if ($this->serviceModel->exists($data['MaDV'])) {
                $_SESSION['error'] = 'Mã dịch vụ đã tồn tại.';
                $_SESSION['form'] = $data;
                header('Location: /admin/service/edit/' . $data['old_id']);
                exit;
            }
        }

        // Cập nhật dịch vụ
        if ($this->serviceModel->update($data)) {
            $_SESSION['success'] = 'Cập nhật dịch vụ thành công!';
        } else {
            $_SESSION['error'] = 'Đã xảy ra lỗi khi cập nhật dịch vụ.';
        }
        header('Location: /service_manage');
        exit;
    }


    public function delete($id)
    {
        $this->serviceModel->delete($id);
        header('Location: /service_manage');
        exit;
    }
}

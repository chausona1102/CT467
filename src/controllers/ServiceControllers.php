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

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;

        $services = $this->serviceModel->getPaginated($limit, $offset);
        $total = $this->serviceModel->countAll();
        $totalPages = ceil($total / $limit);


        if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] === true) {
            $data = [
                'services' => $services,
                'totalPages' => $totalPages,
                'currentPage' => $page,
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
        $success = $this->serviceModel->save($data); // Tạo thêm hàm create() trong model

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
            // 'service' => $serviceMdl->getServiceById($id) // Example of fetching service data by ID
        ];
        $this->render('admin/edit_service', $data);
    }
    public function delete($id)
    {
        // Code to delete a service by ID
    }
}

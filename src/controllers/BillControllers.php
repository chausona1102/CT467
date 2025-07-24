<?php

namespace App\controllers;

use App\models\BillModel;
use GrahamCampbell\ResultType\Success;

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
        $data = [
            // 'services' => $serviceMdl->select() // Example of fetching services for the form
        ];
        $this->render('admin/create_bill', $data);
    }

    public function store() {}

    public function edit($id)
    {
        $data = [
            // 'bill' => $billMdl->find($id) // Example of fetching a specific bill for editing
        ];
        $this->render('admin/edit_bill', $data);
    }

    public function update() {}

    public function delete($id)
    {
        // Code to delete a bill by ID
    }
}

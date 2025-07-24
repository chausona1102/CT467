<?php

namespace App\controllers;

use App\controllers\ContractModel;
use App\models\ConTractModel as ModelsConTractModel;

class ContractControllers extends Controller
{
    protected $contractModel;

    public function __construct()
    {
        parent::__construct();
        $this->contractModel = new ModelsConTractModel();
    }
    public function index()
    {
        if (isset($_GET['export']) && $_GET['export'] === 'excel') {

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
        $data = [
            // 'services' => $serviceMdl->select() // Example of fetching services for contract creation
        ];
        $this->render('admin/create_contract', $data);
    }

    public function store() {}

    public function edit($id)
    {
        $data = [
            // 'contract' => $contractMdl->selectById($id) // Example of fetching a contract by ID
        ];
        $this->render('admin/edit_contract', $data);
    }

    public function update() {}

    public function delete($id)
    {
        // Code to delete a contract by ID
    }
}

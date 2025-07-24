<?php

namespace App\controllers;

class ContractControllers extends Controller
{
    public function index()
    {
        $data = [
            // 'contracts' => $contractMdl->select() // Example of fetching contracts
        ];
        if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] === true) {
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

    public function store()
    {

    }

    public function edit($id)
    {
        $data = [
            // 'contract' => $contractMdl->selectById($id) // Example of fetching a contract by ID
        ];
        $this->render('admin/edit_contract', $data);
    }

    public function update()
    {

    }

    public function delete($id)
    {
        // Code to delete a contract by ID
    }
}
<?php

namespace App\controllers;

class ContractControllers extends Controller
{
    public function renderContract()
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

    public function addContract()
    {
        // Code to add a new contract
    }

    public function editContract($id)
    {
        // Code to edit an existing contract by ID
    }

    public function deleteContract($id)
    {
        // Code to delete a contract by ID
    }
}
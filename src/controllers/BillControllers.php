<?php

namespace App\controllers;

class BillControllers extends Controller
{
    public function renderBill()
    {
        $data = [
            // 'bills' => $billMdl->select() // Example of fetching bills
        ];
        if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] === true) {
            $this->render('admin/bill_manage', $data);
        } else {
            header('Location: /login');
            exit();
        }
    }

    public function addBill()
    {
        // Code to add a new bill
    }

    public function editBill($id)
    {
        // Code to edit an existing bill by ID
    }

    public function deleteBill($id)
    {
        // Code to delete a bill by ID
    }

    
}

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
        $data = [
            // 'services' => $serviceMdl->select() // Example of fetching services for the form
        ];
        $this->render('admin/create_bill', $data);
    }

    public function editBill($id)
    {
        $data = [
            // 'bill' => $billMdl->find($id) // Example of fetching a specific bill for editing
        ];
        $this->render('admin/edit_bill', $data);
    }

    public function deleteBill($id)
    {
        // Code to delete a bill by ID
    }

    
}

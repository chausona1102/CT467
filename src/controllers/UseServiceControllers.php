<?php

namespace App\controllers;

class UseServiceControllers extends Controller
{
    public function renderUseService()
    {
        // Code to handle the use of services
        $data = [
            // 'services' => $serviceMdl->select() // Example of fetching services
        ];
        if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] === true) {
            // $serviceMdl = new \App\models\ServiceModel();
            // $data['services'] = $serviceMdl->select();
        } else {
            header('Location: /login');
            exit();
        }
        $this->render('admin/use_service', $data);
    }

    public function addUseService()
    {
        // Code to add a new service usage
    }
    
    public function editUseService($id)
    {
        // Code to edit an existing service usage by ID
    }

    public function deleteUseService($id)
    {
        // Code to delete a service usage by ID
    }
}
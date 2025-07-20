<?php

namespace App\controllers;

class ServiceControllers extends Controller
{
    public function renderService()
    {
        // Code to render the service management page
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
        $this->render('admin/service_manage', $data);
    }

    public function addService()
    {
        $data = [
            // 'service' => $serviceMdl->getServiceData() // Example of fetching service data for creation
        ];
        $this->render('admin/create_service', $data);
    }
    
    public function editService($id)
    {
        // Code to edit an existing service by ID
    }

    public function deleteService($id)
    {
        // Code to delete a service by ID
    }
}

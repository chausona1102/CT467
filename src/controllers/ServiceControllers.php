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
        $this->render('admin/service_manage', $data);
    }

    public function addService()
    {
        // Code to add a new service
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

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
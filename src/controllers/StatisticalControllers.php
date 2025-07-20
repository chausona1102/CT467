<?php

namespace App\controllers;

class StatisticalControllers extends Controller
{
    public function renderStatistical()
    {
        // Here you would typically fetch data from the model to pass to the view
        $data = [
            // 'statistics' => $statisticalMdl->getStatistics() // Example of fetching statistics
        ];
        
        if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] === true) {
            $this->render('admin/statistical_manage', $data);
        } else {
            header('Location: /login');
            exit();
        }
    }

    
}


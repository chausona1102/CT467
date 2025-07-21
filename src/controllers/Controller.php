<?php

namespace App\controllers;

use League\Plates\Engine;

class Controller
{
    protected $view;

    public function __construct()
    {
        $this->view = new Engine(__DIR__ . '/../views', 'php');
        // $this->view->addFolder('partials', __DIR__ . '/../views/partials');
    }
    public function render($template, $data = [])
    {
        echo $this->view->render($template, $data);
    }
}

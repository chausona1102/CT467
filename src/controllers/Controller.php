<?php

namespace App\controllers;

use League\Plates\Engine;

class Controller
{
    protected $view;

    public function __construct()
    {
        $this->view = new Engine(__DIR__ . '/../views', 'php');
    }
    public function render($template, $data = [])
    {
        echo $this->view->render($template, $data);
    }
}

<?php
    namespace App\controllers;

    class AdminControllers extends Controller
    {
        //  public function __construct()
        // {
        //     if (!isset($_SESSION['isAdmin']) || ($_SESSION['isAdmin'] !== true)) {
        //         header('Location: /login');
        //     }
        //     parent::__construct();
        // }

        public function renderUser()
        {
            $userMdl = new \App\models\UserModel();
            $data = [
                // 'users' => $userMdl->select()
            ];
            $this->render('admin/admin', $data);
        }
    }
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
            if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] === true) {
                $data['users'] = $userMdl->select();
            } else {
                header('Location: /login');
                exit();
            }
            $this->render('admin/admin', $data);
        }
    }
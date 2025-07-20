<?php 

    namespace App\Controllers;

    class LoginControllers extends Controller
    {
        public function renderLogin() {
            $data = [];
            $this->render("login",$data);
        }
        public function check()
    {
        $usern = trim($_POST["username"]);
        $pw = $_POST["password"];

        $userMdl = new \App\models\UserModel();
        $user = $userMdl->selectByUsername($usern);


        if (!$user) {
            echo "<script>alert('Sai tên tài khoản')</script>";
            echo "<script>window.location.href = '/login';</script>";
            exit();
        } else if ($user && password_verify($pw, $user["password"])) {
            $_SESSION["username"] = $usern;
            if ($user['type_account'] == 'admin') {
                $_SESSION['isAdmin'] = true;
                header("location: /");
                exit();
            } else if ($user['type_account'] == 'guest') {
                $_SESSION['user'] = $usern;
                header("location: /error");
                exit();
            }
        } else {
            echo "<script>alert('Sai mật khẩu!')</script>";
            echo "<script>window.location.href = '/login';</script>";
            exit();
        }
    }
    }
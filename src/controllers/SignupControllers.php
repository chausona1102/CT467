<?php
namespace App\controllers;

class SignupControllers extends Controller
{
    public function renderSignup()
    {
        // Logic to render the signup page
        // This could involve fetching any necessary data for the signup form
        $data = [];
        $this->render('/signup', $data);
    }

    public function addUser()
    {
        // Logic to handle user signup
        // This could involve validating input and saving the new user to a database
        $username = trim($_POST["username"]);
        $password = $_POST["password"];
        $confirmPassword = $_POST["confirm_password"];

        if ($password !== $confirmPassword) {
            echo "<script>alert('Mật khẩu không khớp!')</script>";
            echo "<script>window.location.href = '/signup';</script>";
            exit();
        }

        $userMdl = new \App\models\UserModel();
        if ($userMdl->selectByUsername($username)) {
            echo "<script>alert('Tên tài khoản đã tồn tại!')</script>";
            echo "<script>window.location.href = '/signup';</script>";
            exit();
        }

        $data = [
            'username' => $username,
            'password' => $password
        ];

        if ($userMdl->addUser($data)) {
            echo "<script>alert('Đăng ký thành công!')</script>";
            echo "<script>window.location.href = '/login';</script>";
        } else {
            echo "<script>alert('Đăng ký thất bại!')</script>";
            echo "<script>window.location.href = '/signup';</script>";
        }
    }

    public function editUser($id)
    {
        // Logic to edit an existing user by ID
        // This could involve fetching data from a database and updating it
        echo "Edit User functionality not implemented yet for user ID: $id";
    }
}
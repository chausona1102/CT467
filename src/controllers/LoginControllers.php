<?php 

    namespace App\Controllers;

    class LoginControllers extends Controller
    {
        public function renderLogin() {
            $data = [];
            $this->render("login",$data);
        }
        public function checkLogin() {
            // Logic to check login credentials
            // This could involve checking against a database or an authentication service
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $username = $_POST['username'] ?? '';
                $password = $_POST['password'] ?? '';

                // Here you would typically check the credentials against a database
                // For demonstration, let's assume the credentials are valid
                if ($username === 'admin' && $password === 'password') {
                    // Redirect to the home page or dashboard after successful login
                    header('Location: /home');
                    exit;
                } else {
                    // Handle invalid credentials
                    $data = ['error' => 'Invalid username or password'];
                    $this->render('login', $data);
                }
            } else {
                // If not a POST request, redirect to the login page
                header('Location: /login');
                exit;
            }
        }
    }
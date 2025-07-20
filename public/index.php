<?php

require_once __DIR__ . '/../config/bootstrap.php';
$router = new \Bramus\Router\Router();

$router->get('/test', function() {
    echo 'Test route';
});

// Home route
$router->get("/","App\controllers\AdminControllers@renderUser");
$router->get("/home","App\controllers\AdminControllers@renderUser");
$router->get("/admin","App\controllers\AdminControllers@renderUser");

// Signup route
$router->get("/signup","App\controllers\SignupControllers@renderSignup");
$router->post("/signup","App\controllers\SignupControllers@addUser");

// Login route
$router->get("/login","App\controllers\LoginControllers@renderLogin");
$router->post("/login","App\controllers\LoginControllers@check");

// Logout route
$router->post("/logout", function() {
    session_start();
    session_destroy();
    header("Location: /login");
    exit();
});

// Room management routes
$router->get("/room_manage","App\controllers\RoomControllers@renderRoom");
$router->get("/filter_function","App\controllers\RoomControllers@filter_function");


// Student management routes
$router->get("/student_manage","App\controllers\StudentControllers@renderStudent");
$router->get("/filter_student","App\controllers\StudentControllers@filter_student");

// service management routes
$router->get("/service_manage","App\controllers\ServiceControllers@renderService");
$router->get("/admin/service/create","App\controllers\ServiceControllers@addService");
// Use service management routes
$router->get("/use_service","App\controllers\UseServiceControllers@renderUseService");

// Bill management routes
$router->get("/bill_manage","App\controllers\BillControllers@renderBill");
$router->run();

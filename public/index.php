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

// Room Type management routes
$router->get("/room_type_manage","App\controllers\RoomTypeControllers@renderRoomType");
$router->get("/filter_room_type","App\controllers\RoomTypeControllers@filter");
$router->post("/room_type_manage/edit","App\controllers\RoomTypeControllers@edit");
$router->post("/room_type_manage/add","App\controllers\RoomTypeControllers@add");
$router->post("/room_type_manage/delete","App\controllers\RoomTypeControllers@delete");


// Student management routes
$router->get("/student_manage","App\controllers\StudentControllers@renderStudent");
$router->get("/filter_student","App\controllers\StudentControllers@filter_student");
$router->post("/student_manage/add", "App\controllers\StudentControllers@addStudent");
$router->post("/student_manage/delete", "App\controllers\StudentControllers@deleleStudent");
$router->post("/student_manage/edit", "App\controllers\StudentControllers@editStudent");



// service management routes
$router->get("/service_manage","App\controllers\ServiceControllers@index");
$router->get("/admin/service/create","App\controllers\ServiceControllers@create");
$router->post("/admin/service/store","App\controllers\ServiceControllers@store");
$router->get("/admin/service/edit/{id}","App\controllers\ServiceControllers@edit");
$router->post("/admin/service/delete/{id}","App\controllers\ServiceControllers@delete");

// Use service management routes
$router->get("/use_service","App\controllers\UseServiceControllers@renderUseService");
$router->get("/admin/use-service/create","App\controllers\UseServiceControllers@addUseService");
$router->get("/admin/use-service/edit/{id}","App\controllers\UseServiceControllers@editUseService");
$router->post("/admin/use-service/delete/{id}","App\controllers\UseServiceControllers@deleteUseService");

// Bill management routes
$router->get("/bill_manage","App\controllers\BillControllers@renderBill");
$router->get("/admin/bill-manage/create","App\controllers\BillControllers@addBill");
$router->get("/admin/bill-manage/edit/{id}","App\controllers\BillControllers@editBill");
$router->post("/admin/bill-manage/delete/{id}","App\controllers\BillControllers@deleteBill");

// Contract management routes
$router->get("/contract_manage","App\controllers\ContractControllers@renderContract");
$router->get("/admin/contract-manage/create","App\controllers\ContractControllers@addContract");
$router->get("/admin/contract-manage/edit/{id}","App\controllers\ContractControllers@editContract");
$router->post("/admin/contract-manage/delete/{id}","App\controllers\ContractControllers@deleteContract");
// Statistical management routes
$router->get("/statistical_manage","App\controllers\StatisticalControllers@renderStatistical");
$router->run();
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

// print route

$router->get('/export_excel_room', 'App\controllers\ExportExcelControllers@exportExcelRoom');
$router->get('/export_excel_student', 'App\controllers\ExportExcelControllers@exportExcelStudent');

// Room management routes
$router->get("/room_manage","App\controllers\RoomControllers@renderRoom");
$router->get("/filter_function","App\controllers\RoomControllers@filter_function");
$router->post("/api/phong/sinhvien", "App\controllers\RoomControllers@laySinhVienTrongPhong");

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
$router->post("/admin/service/update/{id}","App\controllers\ServiceControllers@update");
$router->post("/admin/service/delete/{id}","App\controllers\ServiceControllers@delete");

// Use service management routes
$router->get("/use_service","App\controllers\UseServiceControllers@index");
$router->get("/admin/use-service/create","App\controllers\UseServiceControllers@create");
$router->post("/admin/use-service/store","App\controllers\UseServiceControllers@store");
$router->get("/admin/use-service/edit/{id}","App\controllers\UseServiceControllers@edit");
$router->post("/admin/use-service/update/{id}","App\controllers\UseServiceControllers@update");
$router->post("/admin/use-service/delete/{id}","App\controllers\UseServiceControllers@delete");

// Bill management routes
$router->get("/bill_manage","App\controllers\BillControllers@index");
$router->get("/admin/bill/create","App\controllers\BillControllers@create");
$router->post("/admin/bill/store","App\controllers\BillControllers@store");
$router->get("/admin/bill/edit/{id}","App\controllers\BillControllers@edit");
$router->post("/admin/bill/update/{id}","App\controllers\BillControllers@update");
$router->post("/admin/bill/delete/{id}","App\controllers\BillControllers@delete");

// Contract management routes
$router->get("/contract_manage","App\controllers\ContractControllers@index");
$router->get("/admin/contract/create","App\controllers\ContractControllers@create");
$router->post("/admin/contract/store","App\controllers\ContractControllers@store");
$router->get("/admin/contract/edit/{id}","App\controllers\ContractControllers@edit");
$router->post("/admin/contract/update/{id}","App\controllers\ContractControllers@update");
$router->post("/admin/contract/delete/{id}","App\controllers\ContractControllers@delete");
$router->post("/admin/contract/check/{id}","App\controllers\ContractControllers@check");
// Statistical management routes
$router->get("/statistical_manage","App\controllers\StatisticalControllers@renderStatistical");
$router->run();
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

// Room management routes
$router->get("/room_manage","App\controllers\RoomControllers@renderRoom");

// service management routes
$router->get("/service_manage","App\controllers\ServiceControllers@renderService");
$router->get("/admin/service/create","App\controllers\ServiceControllers@addService");
// Use service management routes
$router->get("/use_service","App\controllers\UseServiceControllers@renderUseService");

// Bill management routes
$router->get("/bill_manage","App\controllers\BillControllers@renderBill");
$router->run();

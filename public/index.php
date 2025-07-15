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




$router->run();

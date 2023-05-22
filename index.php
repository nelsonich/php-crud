<?php

require './vendor/autoload.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


use App\Controllers\ItemController;
use System\Router;

$router = new Router();

$router->get('/api/items', ItemController::class . '::getAll');
$router->post('/api/items', ItemController::class . '::create');
$router->put('/api/items', ItemController::class . '::update');
$router->delete('/api/items', ItemController::class . '::delete');

$router->run();

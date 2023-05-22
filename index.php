<?php

require './vendor/autoload.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


use App\Controllers\ItemController;
use System\Router;

$router = new Router();

$router->get('/api/', ItemController::class . '::getAll');
$router->post('/api/', ItemController::class . '::create');
$router->put('/api/', ItemController::class . '::update');
$router->delete('/api/', ItemController::class . '::delete');

$router->run();

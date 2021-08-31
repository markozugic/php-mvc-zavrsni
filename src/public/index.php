<?php

use App\mvc\App;
use App\controllers\AboutController;
use App\Controllers\ContactController;
use App\Controllers\HomeController;

require_once __DIR__ . './../vendor/autoload.php';

$app = new App(dirname(__DIR__));


// Register routes
$app->router->get('/', [HomeController::class, 'index']);
$app->router->get('/about', [AboutController::class, 'index']);
$app->router->get('/contact', [ContactController::class, 'index']);
$app->router->post('/contact', [ContactController::class, 'send']);

$app->run();
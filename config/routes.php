<?php

use Src\Router;
use App\Controllers\HomeController;
// use App\Controllers\ContactController;

// Cria uma instância do roteador
$router = new Router();

// Registra a rota GET para a home page
$router->addRoute('GET', '/', HomeController::class, 'index');

// Registra a rota POST para o envio de formulário de contato
// $router->addRoute('POST', '/contact', ContactController::class, 'submitForm');

// Roteia a requisição atual
$router->route($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);

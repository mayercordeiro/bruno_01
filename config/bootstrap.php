<?php

use Dotenv\Dotenv;

// Certifique-se de incluir o autoloader do Composer
require_once __DIR__ . '/../vendor/autoload.php';

// Carregar as variáveis do .env
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->safeLoad();

<?php

// Carrega o autoloader do Composer
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/database.php';

ini_set('display_errors', 1); // Exibe erros na saída
ini_set('display_startup_errors', 1); // Exibe erros durante a inicialização do PHP
error_reporting(E_ALL); // Relata todos os tipos de erros

use Dotenv\Dotenv;
use Config\Database;

// Carrega as variáveis do .env
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$db = new Database();
$connection = $db->connect();

// query in users table
// $query = 'SELECT * FROM users';
// $statement = $connection->query($query);
// $users = $statement->fetchAll(PDO::FETCH_ASSOC);

function dd($var)
{
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
    die();
}

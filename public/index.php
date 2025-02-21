<?php

// use Config\Database;

require_once __DIR__ . '/../config/bootstrap.php';

// $pdo = new PDO('mysql:host=db;dbname=my_database', 'user', 'password');
// use Config\Database;

// $database = new Database();
// $pdo = $database->connect();
// dd($pdo);

function dd($var)
{
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
    die();
}

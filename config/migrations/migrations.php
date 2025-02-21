<?php

require_once __DIR__ . '/../database.php';

use Config\Database;

try {
    $db = new Database();
    $pdo = $db->connect();

    $pdo->exec("
        CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL,
            email VARCHAR(100) UNIQUE NOT NULL,
            password VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )
    ");

    echo "Tabela 'users' criada com sucesso!\n";

    $stmt = $pdo->prepare("
        INSERT INTO users (name, email, password) VALUES
        (:name, :email, :password)
    ");

    $stmt->execute([
        'name' => 'Admin',
        'email' => 'admin@example.com',
        'password' => hash('sha256', 'admin123'),
    ]);

    echo "Usuário admin inserido com sucesso!\n";

} catch (PDOException $e) {
    die("Erro ao executar migrations: " . $e->getMessage());
}

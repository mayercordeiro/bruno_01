<?php

namespace Config\Migrations;

class CreateUsersTable extends CreateMigration
{
    public function up(): void
    {
        $this->executeQuery("
            CREATE TABLE IF NOT EXISTS users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(100) NOT NULL,
                email VARCHAR(100) UNIQUE NOT NULL,
                password VARCHAR(255) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )
        ", "UP: Tabela 'users' criada com sucesso!");
    }

    public function seed(): void
    {
        try {
            $this->truncateTable('users');

            // Dados a serem inseridos
            $users = [
                ['name' => 'Administrador', 'email' => 'admin@example.com', 'password' => password_hash('admin123', PASSWORD_DEFAULT)],
                ['name' => 'User1', 'email' => 'user1@example.com', 'password' => password_hash('user123', PASSWORD_DEFAULT)],
                ['name' => 'User2', 'email' => 'user2@example.com', 'password' => password_hash('user456', PASSWORD_DEFAULT)],
                ['name' => 'User3', 'email' => 'user3@example.com', 'password' => password_hash('user789', PASSWORD_DEFAULT)],
            ];

            $this->insertBatch('users', $users);

            echo "SEED: Usuários inseridos com sucesso!\n";
        } catch (\PDOException $e) {
            echo "SEED: Erro ao realizar seed: " . $e->getMessage() . "\n";
        }
    }
}

<?php

namespace Config\Migrations;

class CreateSuppliersTable extends CreateMigration
{
    public function up(): void
    {
        $this->executeQuery("
            CREATE TABLE IF NOT EXISTS suppliers (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                contact_name VARCHAR(255) NULL,
                contact_email VARCHAR(255) NULL,
                contact_phone VARCHAR(20) NULL,
                address TEXT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )
        ", "UP: Tabela 'suppliers' criada com sucesso!");
    }

    public function seed(): void
    {
        try {
            $this->truncateTable('suppliers');

            // Dados a serem inseridos
            $suppliers = [
                ['name' => 'Fornecedor A', 'contact_name' => 'João Silva', 'contact_email' => 'joao@fornecedora.com', 'contact_phone' => '123456789', 'address' => 'Rua A, 123'],
                ['name' => 'Fornecedor B', 'contact_name' => 'Maria Souza', 'contact_email' => 'maria@fornecedorb.com', 'contact_phone' => '987654321', 'address' => 'Av. B, 456'],
                ['name' => 'Fornecedor C', 'contact_name' => 'José Santos', 'contact_email' => 'pedro@fornecedorc.com', 'contact_phone' => '456123789', 'address' => 'Rua C, 789'],
            ];

            $this->insertBatch('suppliers', $suppliers);

            echo "SEED: Fornecedores inseridos com sucesso!\n";
        } catch (\PDOException $e) {
            echo "SEED: Erro ao realizar seed: " . $e->getMessage() . "\n";
        }
    }
}

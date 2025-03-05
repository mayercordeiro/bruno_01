<?php

namespace Config\Migrations;

use PDOException;

class CreateProductsTable extends CreateMigration
{
    public function up(): void
    {
        $this->executeQuery("
            CREATE TABLE IF NOT EXISTS products (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                description TEXT NULL,
                price DECIMAL(10,2) NOT NULL,
                stock_quantity INT DEFAULT 0,
                supplier_id INT NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                FOREIGN KEY (supplier_id) REFERENCES suppliers(id) ON DELETE CASCADE
            )
        ", "Tabela 'products' criada com sucesso!");
    }

    public function seed(): void
    {
        try {
            $this->truncateTable('products');

            // Dados a serem inseridos
            $products = require_once __DIR__ . '/data/products_data.php';

            $this->insertBatch('products', $products);

            echo "SEED: Produtos inseridos com sucesso!\n";
        } catch (\PDOException $e) {
            echo "SEED: Erro ao realizar seed: " . $e->getMessage() . "\n";
        }
    }
}

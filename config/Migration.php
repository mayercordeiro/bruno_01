<?php

namespace Config;

use Config\Database;
use Config\Migrations\CreateUsersTable;
use Config\Migrations\CreateSuppliersTable;
use Config\Migrations\CreateProductsTable;

class Migration
{
    public static function run()
    {
        $database = new Database();
        $pdo = $database->connect();

        $migrations = [
            CreateUsersTable::class,
            CreateSuppliersTable::class,
            CreateProductsTable::class,
        ];

        foreach ($migrations as $migrationClass) {
            echo "MIGRATION: Executando migração: {$migrationClass} \n";

            $migration = new $migrationClass($pdo);

            $migration->up();

            if (method_exists($migration, 'seed')) {
                $migration->seed();
            }

            echo "MIGRATION: Migração {$migrationClass} concluída!\n";
        }
    }
}

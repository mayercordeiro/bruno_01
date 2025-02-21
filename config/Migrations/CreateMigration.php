<?php

namespace Config\Migrations;

use PDO;
use PDOException;

abstract class CreateMigration
{
    public function __construct(protected PDO $pdo) {}

    abstract public function up(): void;

    /**
     * Executa uma query SQL
     * @param string $query Query a ser executada
     * @param string $successMessage Mensagem de sucesso
     *
     * @return void
     */
    public function executeQuery(string $query, string $successMessage = ''): void
    {
        try {
            $this->pdo->exec($query);

            if ($successMessage) {
                echo "$successMessage\n";
            }
        } catch (PDOException $e) {
            $this->handleError("Erro na execução da query: " . $e->getMessage());
        }
    }

    /**
     * Trunca uma tabela
     * @param string $table Nome da tabela a ser truncada
     *
     * @return void
     */
    public function truncateTable(string $table): void
    {
        try {
            // Desabilita as verificações de chave estrangeira temporariamente
            $this->pdo->exec("SET FOREIGN_KEY_CHECKS=0");
            // Trunca a tabela
            $this->pdo->exec("TRUNCATE TABLE {$table}");
            // Habilita as verificações de chave estrangeira
            $this->pdo->exec("SET FOREIGN_KEY_CHECKS=1");
        } catch (PDOException $e) {
            $this->handleError("Erro ao truncar a tabela '{$table}': " . $e->getMessage());
        }
    }

    /**
     * Insere dados em lote
     * @param string $table Nome da tabela
     * @param array $data Dados a serem inseridos
     *
     * @return void
     */
    public function insertBatch(string $table, array $data): void
    {
        if (empty($data)) {
            return;
        }

        // Prepara os dados para a inserção
        $columns = implode(', ', array_keys($data[0]));
        $placeholders = implode(', ', array_map(fn($col) => ":$col", array_keys($data[0])));

        // Inicia a transação
        try {
            $this->pdo->beginTransaction();

            $stmt = $this->pdo->prepare("INSERT INTO {$table} ({$columns}) VALUES ({$placeholders})");

            foreach ($data as $row) {
                $stmt->execute($row);
            }

            // Comita a transação
            $this->pdo->commit();

            echo "INSERTBATCH: Dados inseridos na tabela '{$table}' com sucesso!\n";
        } catch (PDOException $e) {
            // Realiza rollback se houver um erro
            $this->pdo->rollBack();
            $this->handleError("INSERTBATCH: Erro ao inserir dados na tabela '{$table}': " . $e->getMessage());
        }
    }


    private function handleError(string $message): void
    {
        echo $message . "\n";

        throw new PDOException($message);
    }
}

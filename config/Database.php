<?php

namespace Config;

use PDO;
use PDOException;

class Database
{
    private string $host;
    private string $dbName;
    private string $username;
    private string $password;
    private string $charset;
    private PDO|null $connection = null;

    public function __construct()
    {
        // Carrega as variáveis do .env
        // $this->host = 'mysql_db';
        // $this->dbName = 'my_database';
        // $this->username = 'user';
        // $this->password = 'password';
        // $this->charset = 'utf8mb4';
        $this->host = getenv('DB_HOST');
        $this->dbName = getenv('DB_DATABASE');
        $this->username = getenv('DB_USERNAME');
        $this->password = getenv('DB_PASSWORD');
        $this->charset = getenv('DB_CHARSET');
    }

    public function connect(): PDO
    {
        if ($this->connection === null) {
            try {
                $dsn = "mysql:host={$this->host};dbname={$this->dbName};charset={$this->charset}";
                $this->connection = new PDO($dsn, $this->username, $this->password);
                // Configurações adicionais para segurança e desempenho
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                die("Erro na conexão com o banco de dados: " . $e->getMessage());
            }
        }

        return $this->connection;
    }
}

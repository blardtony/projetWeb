<?php 

namespace Database;

use PDO;

class DbConnection {

    private ?PDO $pdo;

    public function __construct(private string $dbname, private string $host, private string $username, private string $password)
    {
        
    }

    public function getPDO(): PDO
    {
        return $this->pdo ?? $this->pdo = new PDO(
            "mysql:dbname={$this->dbname};host={$this->host}",
            $this->username,
            $this->password,
            [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET CHARACTER SET UTF8'
            ]
        );
    }
}
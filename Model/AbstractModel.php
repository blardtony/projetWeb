<?php

namespace Model;

use Database\DbConnection;
use PDO;

abstract class AbstractModel
{
    protected string $table;

    public function __construct(protected DbConnection $db)
    {
        
    }

    public function findAll(): array
    {
        $statement = $this->db->getPDO()->query("SELECT * FROM {$this->table}");
        $statement->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);
        return $statement->fetchAll();
    }

    public function findById(int $id)
    {
        $statement = $this->db->getPDO()->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $statement->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);
        $statement->execute([$id]);
        return $statement->fetch();
    }

    public function update(int $id, array $data)
    {
        $sqlRequest = "";
        $i = 1;

        foreach ($data as $key => $value) {
            $comma = $i++ === count($data) ? "" : ", ";
            $sqlRequest .= "{$key} = :{$key}{$comma}";
        }
        $data['id'] = $id;
        $statement = $this->db->getPDO()->prepare("UPDATE {$this->table} SET {$sqlRequest} WHERE id = :id");

        $statement->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);
        return $statement->execute($data);
    }
}
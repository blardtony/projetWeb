<?php

namespace Model;

use PDO;

class Group extends AbstractModel
{
    protected string $table = 'groups';


    public function findByName(string $name)
    {
        $statement = $this->db->getPDO()->prepare("SELECT * FROM {$this->table} WHERE name = ?");
        $statement->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);
        $statement->execute([$name]);
        return $statement->fetch();

    }

    public function insert(array $data)
    {   
        $sqlRequest = "";
        $sqlRequest1 = "";
        $i = 1;

        foreach ($data as $key => $value) {
            $comma = $i++ === count($data) ? "" : ", ";
            $sqlRequest .= "{$key}{$comma}";
            $sqlRequest1 .= ":{$key}{$comma}";
        }

        $statement = $this->db->getPDO()->prepare("INSERT INTO {$this->table} ({$sqlRequest}) VALUES ({$sqlRequest1})");

        $statement->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);
        return $statement->execute($data);
    }
}
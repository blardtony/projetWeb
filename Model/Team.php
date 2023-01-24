<?php

namespace Model;

use PDO;

class Team extends AbstractModel
{
    protected string $table = 'team';
    
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
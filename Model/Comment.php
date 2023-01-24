<?php

namespace Model;

use Mail\Mail;
use PDO;

class Comment extends AbstractModel
{
    protected string $table = 'comment';

    public function findByGameId(int $id)
    {
        $statement = $this->db->getPDO()->prepare("SELECT (SELECT t.pseudo FROM user t WHERE t.id = g.id_user) as pseudo, g.message, g.posted_at FROM {$this->table} g WHERE g.id_game = ?");
        $statement->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);
        $statement->execute([$id]);
        return $statement->fetchAll();
    }
    public function findWithPseudo()
    {
        $statement = $this->db->getPDO()->prepare("SELECT c.id, (SELECT u.pseudo FROM user u WHERE u.id = c.id_user) as pseudo, c.id_game, c.message, c.posted_at FROM {$this->table} c");
        $statement->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);
        $statement->execute();
        return $statement->fetchAll();
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

    public function delete(int $id)
    {
        $statement = $this->db->getPDO()->prepare("DELETE FROM {$this->table} WHERE id = ?");
        return $statement->execute([$id]);
    } 

}
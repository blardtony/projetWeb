<?php

namespace Model;

use Mail\Mail;
use PDO;

class Bet extends AbstractModel
{
    protected string $table = 'bet';

    public function findByGameId(int $id)
    {
        $statement = $this->db->getPDO()->prepare("SELECT * FROM {$this->table} WHERE game_id = ?");
        $statement->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);
        $statement->execute([$id]);
        return $statement->fetchAll();
    }
    public function findByGameDatailId(int $id)
    {
        $statement = $this->db->getPDO()->prepare("SELECT b.host_score bet_host_score, b.guest_score bet_guest_score, (SELECT t.name FROM team t JOIN game g on g.id = b.game_id WHERE t.id = g.id_host) as host, (SELECT t.name FROM team t JOIN game g on g.id = b.game_id WHERE t.id = g.id_guest) as guest, (SELECT g.start_at FROM game g WHERE g.id = b.game_id) as start_at, (SELECT g.host_score FROM game g WHERE g.id = b.game_id) as host_score, (SELECT g.guest_score FROM game g WHERE g.id = b.game_id) as guest_score, (SELECT u.pseudo FROM user u WHERE u.id = b.user_id) as pseudo FROM {$this->table} b WHERE b.game_id = ?");
        $statement->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);
        $statement->execute([$id]);
        return $statement->fetchAll();
    }

    public function findByUser(int $id)
    {
        $statement = $this->db->getPDO()->prepare("SELECT b.id, b.host_score bet_host_score, b.guest_score bet_guest_score, (SELECT t.name FROM team t JOIN game g on g.id = b.game_id WHERE t.id = g.id_host) as host, (SELECT t.name FROM team t JOIN game g on g.id = b.game_id WHERE t.id = g.id_guest) as guest, (SELECT g.start_at FROM game g WHERE g.id = b.game_id) as start_at, (SELECT g.host_score FROM game g WHERE g.id = b.game_id) as host_score, (SELECT g.guest_score FROM game g WHERE g.id = b.game_id) as guest_score FROM {$this->table} b WHERE user_id = ?");
        $statement->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);
        $statement->execute([$id]);
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

}
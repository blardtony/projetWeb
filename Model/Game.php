<?php

namespace Model;

use PDO;

class Game extends AbstractModel
{
    protected string $table = 'game';

    public function findByGroupAndOrderByDay(int $id, int $idUser)
    {
        $statement = $this->db->getPDO()->prepare("SELECT g.id, g.host_score, g.guest_score, g.day, g.start_at, (SELECT t.name FROM team t WHERE t.id = g.id_host) as host, (SELECT t.name FROM team t WHERE t.id = g.id_guest) as guest, g.id_group, (SELECT b.host_score FROM bet b WHERE b.game_id = g.id AND b.user_id = ?) as bet_score_host, (SELECT b.guest_score FROM bet b WHERE b.game_id = g.id AND b.user_id = ?) as bet_score_guest  FROM {$this->table} g WHERE id_group = ? order by day");
        $statement->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);
        $statement->execute([$idUser, $idUser, $id]);
        return $statement->fetchAll();
    }

    public function findOneByIdWithTeamName(int $id) 
    {
        $statement = $this->db->getPDO()->prepare("SELECT (SELECT t.name FROM team t WHERE t.id = g.id_host) as host, (SELECT t.name FROM team t WHERE t.id = g.id_guest) as guest FROM {$this->table} g WHERE g.id = ?");
        $statement->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);
        $statement->execute([$id]);
        return $statement->fetch();
    }

    public function findTeamsByDay(string $day, int $idTeam, int $idGroup)
    {
        $statement = $this->db->getPDO()->prepare("SELECT id_host, id_guest FROM {$this->table} WHERE day = ? AND id_group = ? AND (id_host = ? OR id_guest = ?)");
        // $statement->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);
        $statement->execute([$day, $idGroup, $idTeam, $idTeam]);
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
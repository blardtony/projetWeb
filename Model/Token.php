<?php

namespace Model;

use DateTime;
use PDO;

class Token extends AbstractModel
{
    protected string $table = 'token';

    public function findByToken(string $token)
    {
        $statement = $this->db->getPDO()->prepare("SELECT * FROM {$this->table} WHERE token = ?");
        $statement->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);
        $statement->execute([$token]);
        return $statement->fetch();

    }

    public function insert(string $email) {
        $token = bin2hex(random_bytes(16));
        $data = [];
        $data["token"] = $token;
        $data["email"] = $email;
        $statement = $this->db->getPDO()->prepare("INSERT INTO {$this->table} (email, token, created_at) VALUES (:email, :token, NOW())");
        $statement->execute($data);
        return $data["token"];
    }

    public function isExpired(string $createdAt) {
        $createdAt = strtotime($createdAt);
        $now = strtotime((new DateTime())->format('Y-m-d H:i:s'));
        return (($now - $createdAt) < 60*5);
    }
}
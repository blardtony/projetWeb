<?php

namespace Model;

use Mail\Mail;
use PDO;

class User extends AbstractModel
{
    protected string $table = 'user';

    public function findByEmail(string $email)
    {
        $statement = $this->db->getPDO()->prepare("SELECT * FROM {$this->table} WHERE email = ?");
        $statement->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);
        $statement->execute([$email]);
        return $statement->fetch();

    }

    public function insert(array $data)
    {
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        
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

    public function token(string $email, string $pseudo, string $token) {
        $subject = "DiamondDogsProject : Token verification";
        $body = '<a href="https://tony.blard.13h37.io/DiamondDogsProject/token-verify?token=' . $token . '">Clique</a>';
        (new Mail())->send($email, $pseudo, $subject, $body);
    }

    public function setActive(string $email) {
        $data['active'] = 1;
        $data['email'] = $email;
        $statement = $this->db->getPDO()->prepare("UPDATE {$this->table} SET active = :active WHERE email = :email");

        $statement->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);
        return $statement->execute($data);
    }

    public function setGroup(int $idGroupe, int $idUser)
    {
        $statement = $this->db->getPDO()->prepare("UPDATE {$this->table} SET id_group = :group WHERE id = :id");

        $statement->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);
        return $statement->execute([
            "group" => $idGroupe,
            "id" => $idUser
        ]);
    }

    public function findByGroup(int $idGroup)
    {
        $statement = $this->db->getPDO()->prepare("SELECT * FROM {$this->table} WHERE id_group = ?");
        $statement->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);
        $statement->execute([$idGroup]);
        return $statement->fetchAll();
    }

    public function sendInvite(string $email, string $pseudo, string $groupName) {
        $subject = "DiamondDogsProject : Invitation group";
        $body = "Vous etes membre du groupe <b>{$groupName}</b>";
        (new Mail())->send($email, $pseudo, $subject, $body);
    }
}
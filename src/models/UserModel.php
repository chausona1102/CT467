<?php

namespace App\models;

use PDO;

class UserModel extends Model
{
    public function select()
    {
        $stmt = $this->conn->prepare("SELECT * FROM account");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM account WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function selectByUsername($username)
    {
        $stmt = $this->conn->prepare("SELECT * FROM account WHERE username = :username");
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function addUser($data)
    {
        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
        $type_account = isset($data['type_account']) ? $data['type_account'] : 'guest';
        $stmt = $this->conn->prepare("INSERT INTO account (username, password, type_account) VALUES (:username, :password, :type_account)");
        $stmt->bindParam(':username', $data['username']);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':type_account', $type_account);

        return $stmt->execute();
    }
}

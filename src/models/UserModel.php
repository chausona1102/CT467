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
            $stmt = $this->conn->prepare("INSERT INTO account (Username, Password) VALUES (:username, :password)");
            $stmt->bindParam(':username', $data['username']);
            $stmt->bindParam(':password', password_hash($data['password'], PASSWORD_DEFAULT));
            return $stmt->execute();
        }
    }
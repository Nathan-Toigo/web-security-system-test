<?php

namespace App\Models;

use PDO;

class VulnerableUserPDO
{
    protected $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findById($id)
    {
        $sql = "SELECT * FROM User WHERE id = $id";
        $stmt = $this->pdo->query($sql);
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $data ? new User($data) : null;
    }

    public function findByEmail($email)
    {
        $sql = "SELECT * FROM User WHERE email = '$email'";
        $stmt = $this->pdo->query($sql);
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $data ? new User($data) : null;
    }

    public function create($data)
    {
        $name = $data['name'];
        $email = $data['email'];
        $password = $data['password'];
        $sql = "INSERT INTO User (name, email, password) VALUES ('$name', '$email', '$password')";
        $success = $this->pdo->exec($sql);
        if ($success) {
            $id = $this->pdo->lastInsertId();
            return $this->findById($id);
        }
        return null;
    }

    public function update($id, $data)
    {
        $name = $data['name'];
        $email = $data['email'];
        $password = $data['password'];
        $sql = "UPDATE User SET name = '$name', email = '$email', password = '$password' WHERE id = $id";
        $success = $this->pdo->exec($sql);
        if ($success) {
            return $this->findById($id);
        }
        return null;
    }

    public function delete($id)
    {
        $user = $this->findById($id);
        $sql = "DELETE FROM User WHERE id = $id";
        $success = $this->pdo->exec($sql);
        return $success ? $user : null;
    }

    public function getAll()
    {   
        $stmt = $this->pdo->query('SELECT * FROM User');
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return array_map(fn($row) => new User($row), $rows);
    }

    public function testUserPassword($email, $password)
    {          
        $stmt = $this->pdo->query('SELECT * FROM User WHERE email = \'' . $email . '\' AND password = \'' . $password . '\'');
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $data ? new User($data) : null;
    }
}
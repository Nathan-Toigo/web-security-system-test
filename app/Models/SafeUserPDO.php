<?php

namespace App\Models;

use PDO;

class SafeUserPDO
{
    protected $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findById($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM User WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $data ? new User($data) : null;
    }

    public function findByEmail($email)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM User WHERE email = :email');
        $stmt->execute(['email' => $email]);
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $data ? new User($data) : null;
    }

    public function create($data)
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO User (name, email, password) VALUES (:name, :email, :password)'
        );
        $success = $stmt->execute([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => $data['password'],
        ]);
        if ($success) {
            $id = $this->pdo->lastInsertId();
            return $this->findById($id);
        }
        return null;
    }

    public function update($id, $data)
    {
        $stmt = $this->pdo->prepare(
            'UPDATE User SET name = :name, email = :email, password = :password WHERE id = :id'
        );
        $success = $stmt->execute([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => $data['password'],
            'id'       => $id,
        ]);
        if ($success) {
            return $this->findById($id);
        }
        return null;
    }

    public function delete($id)
    {
        $user = $this->findById($id);
        $stmt = $this->pdo->prepare('DELETE FROM User WHERE id = :id');
        $success = $stmt->execute(['id' => $id]);
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
        $stmt = $this->pdo->prepare('SELECT * FROM User WHERE email = :email AND password = :password');
        $stmt->execute(['email' => $email,'password' => $password]);
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $data ? new User($data) : null;
    }

    
}
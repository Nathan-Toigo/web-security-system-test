<?php

namespace App\Models;

use PDO;

class TokenUserPDO
{
    protected $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findByToken($token)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM TokenUser JOIN User ON TokenUser.user_id = User.id WHERE token = :token');
        $stmt->execute([':token' => $token]);
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ($row) {
            return new User($row);
        }
        return null;
    }    
}
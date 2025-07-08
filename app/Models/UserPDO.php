<?php

namespace App\Models;

use PDO;

class UserPDO
{
    protected $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findByEmail($email)
    {

    }

    public function addTokenToUser($userId, $token, $expiresAt)
    {
        try {
            $sql = "INSERT INTO TokenUser (user_id, token, created_at, expires_at) VALUES (:user_id, :token, NOW(), :expires_at)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':user_id' => $userId,
                ':token' => $token,
                ':expires_at' => $expiresAt
            ]);

            return true;
        } catch (\PDOException $e) {
            throw $e;
        }
    }

    public function updateEmailByUserToken($token, $newEmail)
    {
        try {
            $sql = "UPDATE User SET email = :email WHERE id = (SELECT user_id FROM TokenUser WHERE token = :token AND expires_at > NOW())";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':email' => $newEmail,
                ':token' => $token
            ]);
            return true;
        } catch (\PDOException $e) {
            throw $e;
        }
    }

    public function updateEmailByRequestToken($token, $newEmail)
    {
        try {
            $sql = "UPDATE User SET email = :email WHERE id = (SELECT user_id FROM TokenRequest WHERE token = :token AND expires_at > NOW())";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':email' => $newEmail,
                ':token' => $token
            ]);
            return true;
        } catch (\PDOException $e) {
            throw $e;
        }
    }
}
<?php

namespace App\Models;

class TokenUser
{

    private ?int $id = null;
    private ?int $user_id = null;
    private ?string $token = null;
    private ?string $created_at = null;
    private ?string $expires_at = null;

    // Getters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function getCreatedAt(): ?string
    {
        return $this->created_at;
    }

    public function getExpiresAt(): ?string
    {
        return $this->expires_at;
    }

    // Setters
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function setUserId(?int $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function setToken(?string $token): void
    {
        $this->token = $token;
    }

    public function setCreatedAt(?string $created_at): void
    {
        $this->created_at = $created_at;
    }

    public function setExpiresAt(?string $expires_at): void
    {
        $this->expires_at = $expires_at;
    }

    // Hydrate function
    public function hydrate(array $data): void
    {
        $this->id = $data['id'] ?? null;
        $this->user_id = $data['user_id'] ?? null;
        $this->token = $data['token'] ?? null;
        $this->created_at = $data['created_at'] ?? null;
        $this->expires_at = $data['expires_at'] ?? null;
    }
}

<?php

namespace App\Models;

use PDO;

class VulnerablePostPDO
{
    protected $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findById($id)
    {
        
    }

    public function findByEmail($email)
    {

    }

    public function create($data)
    {
        
    }

    public function update($id, $data)
    {

    }

    public function delete($id)
    {

    }

    public function getAll()
    {   
        $stmt = $this->pdo->query('SELECT * FROM Post JOIN User ON Post.creator_id = User.id ORDER BY Post.created_at DESC');
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return array_map(function($row) {
            return new Post($row);
        }, $rows);
    }

    public function testUserPassword($email, $password)
    {

    }

    
}
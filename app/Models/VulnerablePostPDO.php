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
        try{
            $title = $data['title'];
            $content = $data['content'];
            $creator_id = $data['creator_id'];

            $sql = "INSERT INTO Post (title, content, creator_id, created_at) VALUES ('".$title."', '" .$content."', $creator_id, NOW())";
            $this->pdo->exec($sql);
            return true;
        } catch (\PDOException $e) {
            throw $e;
        }
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
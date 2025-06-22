<?php

namespace App\Models;

use PDO;

class SafePostPDO
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

            $stmt = $this->pdo->prepare('INSERT INTO Post (title, content, creator_id, created_at) VALUES (:title, :content, :creator_id, NOW())');
            $success = $stmt->execute(['title' => $title,'content' => $content, 'creator_id' => $creator_id]);
            return true;
        } catch (\PDOException $e) {
            throw $e;
        }
    }


    public function getAll()
    {   
        $stmt = $this->pdo->prepare('SELECT * FROM Post JOIN User ON Post.creator_id = User.id ORDER BY Post.created_at DESC');
        $stmt->execute();
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return array_map(function($row) {
            // Sanitize title and content
            if (isset($row['title'])) {
            $row['title'] = strip_tags($row['title']);
            }
            if (isset($row['content'])) {
            $row['content'] = strip_tags($row['content']);
            }
            return new Post($row);
        }, $rows);
    }

    public function testUserPassword($email, $password)
    {

    }

    
}
<?php

namespace App\Models;

use PDO;

class DocumentPDO
{
    protected $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findById($id)
    {
        
    }

    public function getAll()
    {   
        $stmt = $this->pdo->query('SELECT * FROM Document ORDER BY id');
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return array_map(fn($row) => new Document($row), $rows);
    }

    public function insertDocument(Document $document)
    {
        $stmt = $this->pdo->prepare('INSERT INTO Document (path) VALUES (:path)');
        $stmt->bindValue(':path', $document->getPath());
        if (!$stmt->execute()) {
            throw new \Exception("Error inserting document: " . implode(", ", $stmt->errorInfo()));
        }
    }
    
}
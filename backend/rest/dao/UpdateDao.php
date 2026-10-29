<?php
require_once 'BaseDao.php';

class UpdateDao extends BaseDao {
    
    public function __construct() {
        parent::__construct('regulatory_updates');
    }

    // Create (POST)
    public function create($data) {
        $sql = "INSERT INTO regulatory_updates (author_id, title, content, published_at) 
                VALUES (:author_id, :title, :content, :published_at)";
        
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([
            'author_id' => $data['author_id'],
            'title' => $data['title'],
            'content' => $data['content'],
            'published_at' => $data['published_at'] ?? date('Y-m-d H:i:s')
        ]);
        
        return $this->connection->lastInsertId();
    }

    // Update (PUT/PATCH)
    public function update($id, $data) {
        $sql = "UPDATE regulatory_updates SET title = :title, content = :content, published_at = :published_at 
                WHERE id = :id";
        
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute([
            'id' => $id,
            'title' => $data['title'],
            'content' => $data['content'],
            'published_at' => $data['published_at'] ?? date('Y-m-d H:i:s')
        ]);
    }
}
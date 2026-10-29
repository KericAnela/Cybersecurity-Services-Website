<?php
require_once 'BaseDao.php';

class DocumentDao extends BaseDao {
    
    public function __construct() {
        parent::__construct('documents');
    }

    // Create (POST)
    public function create($data) {
        $sql = "INSERT INTO documents (user_id, consultation_id, file_name, file_path) 
                VALUES (:user_id, :consultation_id, :file_name, :file_path)";
        
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([
            'user_id' => $data['user_id'],
            'consultation_id' => $data['consultation_id'] ?? null,
            'file_name' => $data['file_name'],
            'file_path' => $data['file_path']
        ]);
        
        return $this->connection->lastInsertId();
    }

    // Update (PUT/PATCH)
    public function update($id, $data) {
        $sql = "UPDATE documents SET file_name = :file_name, file_path = :file_path, consultation_id = :consultation_id 
                WHERE id = :id";
        
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute([
            'id' => $id,
            'file_name' => $data['file_name'],
            'file_path' => $data['file_path'],
            'consultation_id' => $data['consultation_id'] ?? null
        ]);
    }
}
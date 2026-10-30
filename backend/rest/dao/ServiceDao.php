<?php
require_once 'BaseDao.php';

class ServiceDao extends BaseDao {
    
    public function __construct() {
        parent::__construct('services');
    }

    // Create (POST)
    public function create($data) {
        $sql = "INSERT INTO services (title, description, category, base_price) 
                VALUES (:title, :description, :category, :base_price)";
        
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([
            'title' => $data['title'],
            'description' => $data['description'],
            'category' => $data['category'],
            'base_price' => $data['base_price']
        ]);
        
        return $this->connection->lastInsertId();
    }

    // Update (PUT/PATCH)
    public function update($id, $data) {
        $sql = "UPDATE services SET title = :title, description = :description, category = :category, base_price = :base_price 
                WHERE id = :id";
        
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute([
            'id' => $id,
            'title' => $data['title'],
            'description' => $data['description'],
            'category' => $data['category'],
            'base_price' => $data['base_price']
        ]);
    }
}
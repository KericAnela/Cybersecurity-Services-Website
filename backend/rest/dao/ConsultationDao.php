<?php
require_once 'BaseDao.php';

class ConsultationDao extends BaseDao {
    
    public function __construct() {
        parent::__construct('consultations');
    }

    // Create (POST)
    public function create($data) {
        $sql = "INSERT INTO consultations (user_id, service_id, status, scheduled_date, notes) 
                VALUES (:user_id, :service_id, :status, :scheduled_date, :notes)";
        
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([
            'user_id' => $data['user_id'],
            'service_id' => $data['service_id'],
            'status' => $data['status'] ?? 'Pending',
            'scheduled_date' => $data['scheduled_date'],
            'notes' => $data['notes'] ?? null
        ]);
        
        return $this->connection->lastInsertId();
    }

    // Update (PUT/PATCH)
    public function update($id, $data) {
        $sql = "UPDATE consultations SET service_id = :service_id, status = :status, scheduled_date = :scheduled_date, notes = :notes 
                WHERE id = :id";
        
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute([
            'id' => $id,
            'service_id' => $data['service_id'],
            'status' => $data['status'],
            'scheduled_date' => $data['scheduled_date'],
            'notes' => $data['notes'] ?? null
        ]);
    }
}
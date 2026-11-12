<?php
require_once __DIR__ . '/BaseDao.php';

class UserDao extends BaseDao {
    
    public function __construct() {
        parent::__construct('users');
    }

    public function get_all() {
        return $this->getAll();
    }

    // Create (POST)
    public function create($data) {
        $sql = "INSERT INTO users (full_name, email, username, password_hash, phone, account_type) 
                VALUES (:full_name, :email, :username, :password_hash, :phone, :account_type)";
        
        $stmt = self::$connection->prepare($sql);
        $stmt->execute([
            'full_name' => $data['full_name'],
            'email' => $data['email'],
            'username' => $data['username'],
            'password_hash' => $data['password_hash'],
            'phone' => $data['phone'] ?? null,
            'account_type' => $data['account_type']
        ]);
        
        return self::$connection->lastInsertId();
    }

    // Update (PUT/PATCH)
    public function update($id, $data) {
        $sql = "UPDATE users SET full_name = :full_name, email = :email, phone = :phone, account_type = :account_type 
                WHERE id = :id";
        
        $stmt = self::$connection->prepare($sql);
        return $stmt->execute([
            'id' => $id,
            'full_name' => $data['full_name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'account_type' => $data['account_type']
        ]);
    }
}
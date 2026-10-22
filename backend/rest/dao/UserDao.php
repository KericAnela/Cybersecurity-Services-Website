<?php
require_once __DIR__ . '/BaseDao.php';

class UserDao extends BaseDao {
    public function __construct() {
        // Pass your table name to the parent BaseDao constructor
        parent::__construct('users');
    }

    // Find a user by email
    public function get_by_email($email) {
        return $this->query_unique("SELECT * FROM users WHERE email = :email", ['email' => $email]);
    }

    // Find a user by username
    public function get_by_username($username) {
        return $this->query_unique("SELECT * FROM users WHERE username = :username", ['username' => $username]);
    }

    // Insert a new user
    public function register_user($data) {
        return $this->add([
            'full_name' => $data['full_name'],
            'email' => $data['email'],
            'username' => $data['username'],
            'password_hash' => $data['password_hash'],
            'phone' => $data['phone'] ?? null,
            'account_type' => $data['account_type']
        ]);
    }
}
?>
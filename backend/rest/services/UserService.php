<?php
require_once __DIR__ . '/BaseService.php';
require_once __DIR__ . '/../dao/UserDao.php';

class UserService extends BaseService {

    public function __construct() {
        parent::__construct(new UserDao());
    }

    public function create($data) {
        if (empty($data['full_name'])) {
            throw new Exception("Full name is required.");
        }
        if (empty($data['email'])) {
            throw new Exception("Email address is required.");
        }
        if (empty($data['username'])) {
            throw new Exception("Username is required.");
        }
        if (empty($data['account_type'])) {
            throw new Exception("Account type is required.");
        }

        if (empty($data['password_hash']) && !empty($data['password'])) {
            $data['password_hash'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        if (empty($data['password_hash'])) {
            throw new Exception("Password is required.");
        }

        return $this->dao->create($data);
    }

    public function update($id, $data) {
        if (empty($data['full_name'])) {
            throw new Exception("Full name is required for update.");
        }
        if (empty($data['email'])) {
            throw new Exception("Email address is required for update.");
        }
        if (empty($data['account_type'])) {
            throw new Exception("Account type is required for update.");
        }

        return $this->dao->update($id, $data);
    }
}
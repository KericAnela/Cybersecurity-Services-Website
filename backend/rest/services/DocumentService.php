<?php
require_once __DIR__ . '/BaseService.php';
require_once __DIR__ . '/../dao/DocumentDao.php';

class DocumentService extends BaseService {

    public function __construct() {
        parent::__construct(new DocumentDao());
    }

    public function create($data) {
        if (empty($data['user_id'])) {
            throw new Exception("User ID is required.");
        }
        if (empty($data['file_name']) || empty($data['file_path'])) {
            throw new Exception("File name and file path are required.");
        }

        return $this->dao->create($data);
    }

    public function update($id, $data) {
        if (empty($data['file_name']) || empty($data['file_path'])) {
            throw new Exception("File name and file path are required for update.");
        }

        return $this->dao->update($id, $data);
    }
}
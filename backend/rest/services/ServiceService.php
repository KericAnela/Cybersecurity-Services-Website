<?php
require_once __DIR__ . '/BaseService.php';
require_once __DIR__ . '/../dao/ServiceDao.php';

class ServiceService extends BaseService {

    public function __construct() {
        parent::__construct(new ServiceDao());
    }

    public function create($data) {
        if (empty($data['title'])) {
            throw new Exception("Service title is required.");
        }
        if (!isset($data['base_price']) || !is_numeric($data['base_price'])) {
            throw new Exception("A valid base price is required.");
        }

        return $this->dao->create($data);
    }

    public function update($id, $data) {
        if (empty($data['title'])) {
            throw new Exception("Service title is required for update.");
        }
        if (!isset($data['base_price']) || !is_numeric($data['base_price'])) {
            throw new Exception("A valid base price is required for update.");
        }

        return $this->dao->update($id, $data);
    }
}
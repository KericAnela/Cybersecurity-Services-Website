<?php
require_once __DIR__ . '/BaseService.php';
require_once __DIR__ . '/../dao/UpdateDao.php';

class UpdateService extends BaseService {

    public function __construct() {
        parent::__construct(new UpdateDao());
    }

    public function create($data) {
        if (empty($data['author_id'])) {
            throw new Exception("Author ID is required.");
        }
        if (empty($data['title'])) {
            throw new Exception("Update title is required.");
        }
        if (empty($data['content'])) {
            throw new Exception("Update content is required.");
        }

        if (empty($data['published_at'])) {
            $data['published_at'] = date('Y-m-d H:i:s');
        }

        return $this->dao->create($data);
    }

    public function update($id, $data) {
        if (empty($data['title'])) {
            throw new Exception("Update title is required for update.");
        }
        if (empty($data['content'])) {
            throw new Exception("Update content is required for update.");
        }

        if (empty($data['published_at'])) {
            $data['published_at'] = date('Y-m-d H:i:s');
        }

        return $this->dao->update($id, $data);
    }
}
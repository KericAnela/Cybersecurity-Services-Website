<?php
require_once __DIR__ .'/BaseService.php';
require_once __DIR__ . '/../dao/ConsultationDao.php';

class ConsultationService extends BaseService {

    public function __construct() {
        parent::__construct(new ConsultationDao());
    }

    public function create($data) {
        // Business logic validation
        if (empty($data['scheduled_date'])) {
            throw new Exception("Scheduled date is required.");
        }

        // Set default status if not provided
        if (!isset($data['status'])) {
            $data['status'] = 'Pending';
        }

        // Call the DAO method directly using $this->dao
        return $this->dao->create($data);
    }

    public function update($id, $data) {
        if (empty($data['service_id']) || empty($data['scheduled_date'])) {
            throw new Exception("Service ID and scheduled date are required for update.");
        }

        // Call the DAO method directly using $this->dao
        return $this->dao->update($id, $data);
    }
}
?>